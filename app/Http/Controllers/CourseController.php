<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'unique:courses', 'string'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'credits' => ['required', 'integer', 'min:1', 'max:4'],
            'instructor_name' => ['required', 'string'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load('students');
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'unique:courses,code,' . $course->id],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'credits' => ['required', 'integer', 'min:1', 'max:4'],
            'instructor_name' => ['required', 'string'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        $course->update($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }


    public function enroll(Request $request, Course $course)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return back()->with('error', 'Please create a student profile first.');
        }

        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        if ($course->students()->count() >= $course->capacity) {
            return back()->with('error', 'Course is full.');
        }

        $student->courses()->attach($course->id, ['status' => 'enrolled']);

        return back()->with('success', 'Enrolled in course successfully!');
    }


    public function drop(Course $course)
    {
        $student = Auth::user()->student;

        if (!$student) {
        }

        $student->courses()->detach($course->id);

        return back()->with('success', 'Dropped course successfully!');
    }
}
