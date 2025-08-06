@extends('layouts.admin.app')

@section('page-title', 'PROFILE')

@section('content')
@php
    $profilePicture = $admin->profile_picture;
    $profilePath = public_path($profilePicture);
    $profileUrl = (!empty($profilePicture) && file_exists($profilePath))
        ? asset($profilePicture)
        : asset('images/defaultprofile.jpg');
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center justify-content-between">
                    <span><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="bg-white rounded shadow-sm p-4">
                <!-- Avatar & Name -->
                <div class="text-center mb-4">
                    <div class="profile-img-wrapper mx-auto mb-3">
                        <img src="{{ $profileUrl }}" class="avatar" alt="Profile Picture" onerror="this.onerror=null;this.src='{{ asset('images/defaultprofile.jpg') }}';">
                    </div>
                    <h5 class="mt-3">{{ $admin->first_name }} {{ $admin->last_name }}</h5>
                    <p class="text-muted">{{ ucfirst($admin->role) }}</p>
                </div>

                <!-- Personal Info -->
                <h4 class="mb-4">Personal Information</h4>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <div class="form-control bg-light">{{ $admin->first_name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <div class="form-control bg-light">{{ $admin->last_name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <div class="form-control bg-light">{{ $admin->email }}</div>
                            <span class="input-group-text text-success">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <div class="form-control bg-light">{{ $admin->phone_number ?? 'Not provided' }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-warning text-white px-4">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        background-color: #f0f0f0;
        aspect-ratio: 1 / 1;
    }

    .form-control.bg-light {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
    }

    .btn-warning:hover {
        background-color: #d97706;
    }

    .fade {
        transition: opacity 0.5s ease-out;
        opacity: 0 !important;
    }
</style>

<script>
    // Auto-dismiss alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    });
</script>
@endsection
