@extends('layouts.app')

@section('title', $student->user->name . ' - StudentPortal')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1><i class="bi bi-person-fill"></i> {{ $student->user->name }}</h1>
                <p class="mb-0">{{ $student->department }} - Semester {{ $student->semester }}</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('students.edit', $student) }}" class="btn btn-light">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div style="font-size: 4rem; color: #667eea; margin-bottom: 10px;">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <h5 class="card-title">{{ $student->user->name }}</h5>
                    <p class="text-muted">{{ $student->user->email }}</p>

                    <div class="mb-3">
                        <span class="badge bg-primary me-2">{{ $student->roll_no }}</span>
                        <span class="badge bg-info">Semester {{ $student->semester }}</span>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit Profile
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="bi bi-trash"></i> Delete Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Roll Number</small>
                        <strong>{{ $student->roll_no }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Department</small>
                        <strong>{{ $student->department }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Semester</small>
                        <strong>{{ $student->semester }}</strong>
                    </div>
                    @if ($student->phone)
                        <div class="mb-3">
                            <small class="text-muted d-block">Phone</small>
                            <strong><i class="bi bi-telephone"></i> {{ $student->phone }}</strong>
                        </div>
                    @endif
                    @if ($student->date_of_birth)
                        <div class="mb-3">
                            <small class="text-muted d-block">Date of Birth</small>
                            <strong>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') }}</strong>
                        </div>
                    @endif
                    @if ($student->address)
                        <div class="mb-0">
                            <small class="text-muted d-block">Address</small>
                            <strong>{{ $student->address }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-book"></i> Enrolled Courses</h5>
                </div>
                <div class="card-body">
                    @if ($student->courses()->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Course Name</th>
                                        <th>Instructor</th>
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
                                            <td>{{ $course->instructor_name }}</td>
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
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> This student is not enrolled in any courses.
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history"></i> Activity</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0">
                        <small>Created: {{ $student->created_at->format('M d, Y h:i A') }}</small>
                    </p>
                    <p class="text-muted mb-0">
                        <small>Last Updated: {{ $student->updated_at->format('M d, Y h:i A') }}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
