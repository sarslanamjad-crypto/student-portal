@extends('layouts.app')

@section('title', 'Courses - StudentPortal')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1><i class="bi bi-book-half"></i> Courses</h1>
                <p class="mb-0">Browse and manage available courses</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('courses.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle"></i> Add New Course
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

    <div class="row">
        @forelse ($courses as $course)
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $course->name }}</h5>
                        <small class="badge bg-light text-dark">{{ $course->code }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">{{ Str::limit($course->description, 100) ?? 'No description' }}</p>

                        <div class="mb-3">
                            <small class="text-muted">Instructor</small>
                            <div class="fw-bold">{{ $course->instructor_name }}</div>
                        </div>

                        <div class="row text-center mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Credits</small>
                                <strong>{{ $course->credits }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Semester</small>
                                <strong>{{ $course->semester }}</strong>
                            </div>
                        </div>

                        <div class="progress mb-2" style="height: 25px;">
                            @php
                                $enrolled = $course->students()->count();
                                $capacity = $course->capacity;
                                $percentage = ($enrolled / $capacity) * 100;
                            @endphp
                            <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                 aria-valuenow="{{ $enrolled }}" aria-valuemin="0" aria-valuemax="{{ $capacity }}">
                                {{ $enrolled }}/{{ $capacity }}
                            </div>
                        </div>

                        @if ($enrolled >= $capacity)
                            <span class="badge bg-danger">Full</span>
                        @else
                            <span class="badge bg-success">{{ $capacity - $enrolled }} seats left</span>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> View Details
                        </a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #0dcaf0;"></i>
                    <p class="text-muted mt-3">No courses found</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($courses->hasPages())
        <div class="mt-4">
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
