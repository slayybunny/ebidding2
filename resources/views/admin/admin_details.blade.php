@extends('layouts.admin.app')

@section('page-title', 'BUTIRAN ADMIN')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">Butiran Admin</h5>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Penuh:</strong> {{ $admin->first_name }} {{ $admin->last_name }}</p>
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                    <p><strong>Peranan:</strong> {{ ucfirst($admin->role) }}</p>
                    <p><strong>Status:</strong>
                        @php
                        $is_active = $admin->status == 1 || $admin->status === 'Active';
                        $last_login = \Carbon\Carbon::parse($admin->last_login_at ?? $admin->created_at);
                        $is_locked = $last_login->diffInMonths(\Carbon\Carbon::now()) >= 3 && $is_active;
                        @endphp
                        @if($is_locked)
                        <span class="badge badge-locked">Locked</span>
                        @elseif($is_active)
                        <span class="badge badge-active">Active</span>
                        @else
                        <span class="badge badge-inactive">Non-Active</span>
                        @endif
                    </p>
                    <p><strong>Username:</strong> {{ $admin->username ?? 'AD' . str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Tarikh Pendaftaran:</strong> {{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}</p>
                    <p><strong>Log Masuk Terakhir:</strong> {{ \Carbon\Carbon::parse($admin->last_login_at ?? $admin->created_at)->diffForHumans() }}</p>
                </div>
            </div>

            <a href="{{ route('admin.manage_users') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Senarai Pengguna
            </a>
        </div>
    </div>
</div>
@endsection