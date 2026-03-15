@extends('layouts.app')

@section('title', 'Create Student - StudentPortal')

@section('content')
<div class="dashboard-header">
    <div class="container">
        <h1><i class="bi bi-person-plus"></i> Create Student Profile</h1>
        <p class="mb-0">Add a new student to the system</p>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> <strong>Validation Errors!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('students.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="roll_no" class="form-label">Roll Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('roll_no') is-invalid @enderror"
                               id="roll_no" name="roll_no" value="{{ old('roll_no') }}"
                               placeholder="e.g., CS-2021-001" required>
                        @error('roll_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-select @error('department') is-invalid @enderror"
                                id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="Computer Science" {{ old('department') === 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                            <option value="Software Engineering" {{ old('department') === 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                            <option value="Information Technology" {{ old('department') === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                            <option value="Artificial Intelligence" {{ old('department') === 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                            <option value="Cybersecurity" {{ old('department') === 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                        </select>
                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('semester') is-invalid @enderror"
                               id="semester" name="semester" value="{{ old('semester') }}"
                               min="1" max="8" required>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g., +92 3XX-XXXXXXX">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" rows="3" placeholder="Enter your address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                               id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Create Student
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
