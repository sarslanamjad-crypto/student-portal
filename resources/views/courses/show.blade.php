@extends('layouts.app')

@section('title', $course->name . ' - StudentPortal')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1><i class="bi bi-book-fill"></i> {{ $course->name }}</h1>
                <p class="mb-0 text-uppercase" style="letter-spacing: 0.5px;">{{ $course->code }}</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-light">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div style="font-size: 3rem; color: #667eea; margin-bottom: 15px; text-align: center;">
                        <i class="bi bi-book"></i>
                    </div>

                    <div class="mb-3 text-center">
                        <h6>{{ $course->code }}</h6>
                        <p class="text-muted mb-0 small">Course Code</p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <small class="text-muted d-block">Instructor</small>
                        <strong>{{ $course->instructor_name }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Credits</small>
                        <strong>{{ $course->credits }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Semester</small>
                        <strong>{{ $course->semester }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Capacity</small>
                        <strong>{{ $course->capacity }} students</strong>
                    </div>

                    @php
                        $enrolled = $course->students()->count();
                        $percentage = ($enrolled / $course->capacity) * 100;
                    @endphp

                    <div class="progress mb-2" style="height: 25px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                             aria-valuenow="{{ $enrolled }}" aria-valuemin="0" aria-valuemax="{{ $course->capacity }}">
                            {{ $enrolled }}/{{ $course->capacity }}
                        </div>
                    </div>

                    @if ($enrolled >= $course->capacity)
                        <div class="alert alert-danger mb-3">
                            <small><i class="bi bi-exclamation-circle"></i> Course is full</small>
                        </div>
                    @else
                        <div class="alert alert-success mb-3">
                            <small><i class="bi bi-check-circle"></i> {{ $course->capacity - $enrolled }} seats available</small>
                        </div>
                    @endif

                    @auth
                        @if (auth()->user()->student)
                            @if (auth()->user()->student->courses()->where('course_id', $course->id)->exists())
                                <form action="{{ route('courses.drop', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-x-circle"></i> Drop Course
                                    </button>
                                </form>
                            @elseif ($enrolled < $course->capacity)
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle"></i> Enroll in Course
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                <small><i class="bi bi-exclamation-triangle"></i> Create a student profile first</small>
                            </div>
                            <a href="{{ route('students.create') }}" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle"></i> Create Profile
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Login to Enroll
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            @if ($course->description)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-file-text"></i> Course Description</h5>
                    </div>
                    <div class="card-body">
                        {{ $course->description }}
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-people"></i> Enrolled Students ({{ $course->students()->count() }})</h5>
                </div>
                <div class="card-body">
                    @if ($course->students()->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->students as $student)
                                        <tr>
                                            <td><span class="badge bg-info">{{ $student->roll_no }}</span></td>
                                            <td><strong>{{ $student->user->name }}</strong></td>
                                            <td>{{ $student->user->email }}</td>
                                            <td>
                                                @if ($student->pivot->status === 'enrolled')
                                                    <span class="badge bg-success">Enrolled</span>
                                                @elseif ($student->pivot->status === 'completed')
                                                    <span class="badge bg-primary">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">Dropped</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->pivot->grade ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> No students enrolled in this course yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
