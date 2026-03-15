<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $students = Student::with('user', 'courses')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'roll_no' => ['required', 'unique:students', 'string'],
            'department' => ['required', 'string'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
        ]);

        $validated['user_id'] = Auth::id();
        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student profile created successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }


    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'roll_no' => ['required', 'string', 'unique:students,roll_no,' . $student->id],
            'department' => ['required', 'string'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)->with('success', 'Student profile updated successfully!');
    }


    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
