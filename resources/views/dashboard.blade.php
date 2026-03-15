@extends('layouts.app')

@section('title', 'Dashboard - StudentPortal')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1><i class="bi bi-speedometer2"></i> Welcome, {{ Auth::user()?->name ?? 'Guest' }}!</h1>
        <p class="mb-0">Manage your courses and student profile</p>
    </div>
</div>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        @php
            $student = Auth::user()?->student;
            $totalCourses = $student ? $student->courses()->count() : 0;
            $totalStudents = \App\Models\Student::count();
            $totalCoursesAvailable = \App\Models\Course::count();
        @endphp

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="number">{{ $totalStudents }}</div>
                    <div class="label">Total Students</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="number">{{ $totalCoursesAvailable }}</div>
                    <div class="label">Available Courses</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="number">{{ $totalCourses }}</div>
                    <div class="label">My Enrollments</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="number">{{ $student ? $student->semester : 'N/A' }}</div>
                    <div class="label">Current Semester</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-book"></i> My Courses</h5>
                </div>
                <div class="card-body">
                    @if ($student && $student->courses()->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Status</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->courses as $course)
                                        <tr>
                                            <td><span class="badge bg-info">{{ $course->code }}</span></td>
                                            <td>{{ $course->name }}</td>
                                            <td>
                                                @if ($course->pivot->status === 'enrolled')
                                                    <span class="badge bg-success">Enrolled</span>
                                                @elseif ($course->pivot->status === 'completed')
                                                    <span class="badge bg-primary">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">Dropped</span>
                                                @endif
                                            </td>
                                            <td>{{ $course->pivot->grade ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> You are not enrolled in any courses.
                            <a href="{{ route('courses.index') }}" class="alert-link">Browse courses</a> to enroll.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person"></i> Student Profile</h5>
                </div>
                <div class="card-body">
                    @if ($student)
                        <div class="mb-3">
                            <small class="text-muted">Roll Number</small>
                            <div class="fw-bold">{{ $student->roll_no }}</div>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Department</small>
                            <div class="fw-bold">{{ $student->department }}</div>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Semester</small>
                            <div class="fw-bold">{{ $student->semester }}</div>
                        </div>
                        @if ($student->phone)
                            <div class="mb-3">
                                <small class="text-muted">Phone</small>
                                <div class="fw-bold">{{ $student->phone }}</div>
                            </div>
                        @endif
                        @if ($student->address)
                            <div class="mb-3">
                                <small class="text-muted">Address</small>
                                <div class="fw-bold">{{ $student->address }}</div>
                            </div>
                        @endif
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary w-100">
                            <i class="bi bi-pencil"></i> Edit Profile
                        </a>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> No student profile found.
                        </div>
                        <a href="{{ route('students.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Create Student Profile
                        </a>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-quicklinks"></i> Quick Links</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-people"></i> View All Students
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-book-half"></i> Browse All Courses
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
