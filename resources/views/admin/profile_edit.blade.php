@extends('layouts.admin.app')

@section('page-title', 'EDIT PROFILE')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Profile</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="profileForm" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-8 text-center mb-4">
            @php
    $avatarFile = $admin->avatar ?? null;
    $avatarUrl = $avatarFile && file_exists(public_path('storage/avatars/admin/' . $avatarFile))
        ? asset('storage/avatars/admin/' . $avatarFile)
        : asset('images/default-avatar.png');
@endphp

<img src="{{ $avatarUrl }}"
     alt="Profile Picture"
     class="avatar-image"
     id="profilePicturePreview"
     onerror="this.src='{{ asset('images/default-avatar.png') }}';">

                <div class="mt-2">
                    <label for="profile_picture" style="cursor: pointer;" title="Change Profile Picture">
                        <i class="fas fa-pencil-alt fa-lg text-primary bg-white rounded-circle p-2 shadow-sm"></i>
                    </label>
                    <input type="file" class="d-none" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewProfilePicture(event)">
                    <input type="hidden" name="current_profile_picture" value="{{ $admin->avatar }}">

                </div>
            </div>

            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $admin->first_name) }}" class="form-control track-change" data-original="{{ $admin->first_name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $admin->last_name) }}" class="form-control track-change" data-original="{{ $admin->last_name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="{{ old('username', $admin->username) }}" class="form-control track-change" data-original="{{ $admin->username }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control track-change" data-original="{{ $admin->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $admin->phone_number) }}" class="form-control track-change" data-original="{{ $admin->phone_number }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($admin->role) }}" readonly>
                        <input type="hidden" name="role" value="{{ $admin->role }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">New Password (optional)</label>
                        <input type="password" name="password" class="form-control track-change">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control track-change">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button id="submitBtn" type="submit" class="btn btn-primary px-5" disabled>Update Profile</button>
                    <a href="{{ route('admin.profile') }}" class="btn btn-secondary ms-2 px-5">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .avatar-image {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .fa-pencil-alt:hover {
        transform: scale(1.1);
    }
    .fade {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>

<script>
    function previewProfilePicture(event) {
        const preview = document.getElementById('profilePicturePreview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        hasChanged = true;
        submitBtn.disabled = false;
    }

    const formInputs = document.querySelectorAll('.track-change');
    const submitBtn = document.getElementById('submitBtn');
    let hasChanged = false;

    formInputs.forEach(input => {
        input.addEventListener('input', () => {
            hasChanged = false;
            formInputs.forEach(field => {
                const original = field.dataset.original;
                if (original !== undefined && field.value !== original) {
                    hasChanged = true;
                }
                if ((field.name === "password" || field.name === "password_confirmation") && field.value !== "") {
                    hasChanged = true;
                }
            });
            submitBtn.disabled = !hasChanged;
        });
    });

    document.getElementById('profileForm').addEventListener('submit', function(e) {
        if (!hasChanged) {
            e.preventDefault();
            alert("No changes detected.");
        }
    });

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
