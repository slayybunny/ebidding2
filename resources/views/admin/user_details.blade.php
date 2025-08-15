@extends('layouts.admin.app')

@section('page-title', 'USER DETAILS')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-4">User Details</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Full Name:</strong> {{ $user->name ?? $user->first_name . ' ' . $user->last_name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> {{ ucfirst($user->role ?? 'user') }}</p>
                        <p><strong>Status:</strong>
                            @php
                                $is_active = $user->status == 1 || $user->status === 'Active';
                                $last_login = \Carbon\Carbon::parse($user->last_login_at ?? $user->created_at);
                                $is_locked = $last_login->diffInMonths(\Carbon\Carbon::now()) >= 3 && $is_active;
                            @endphp
                            @if ($is_locked)
                                <span class="badge badge-locked">Locked</span>
                            @elseif($is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </p>
                        <p><strong>User Code:</strong>
                            {{ $user->user_code ?? 'US' . str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</p>
                        <p><strong>Registration Date:</strong>
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</p>
                        <p><strong>Last Login:</strong>
                            {{ \Carbon\Carbon::parse($user->last_login_at ?? $user->created_at)->diffForHumans() }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.manage_users') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left"></i> Back to User List
                </a>
            </div>
        </div>
    </div>
@endsection
