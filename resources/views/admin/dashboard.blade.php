@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
                <p class="text-muted mb-0">Welcome back! Here's what's happening with your auctions today.</p>
            </div>
            <div class="text-muted">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ date('l, F j, Y') }}
            </div>
        </div>

        <div class="row g-4 mb-5 justify-content-center">
            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-gold-light rounded-3 p-3">
                                    <i class="fas fa-users text-gold fa-2x"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Active Users</h6>
                                <h2 class="mb-0 text-gold">{{ $activeUsers }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> +12% from last week
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-gold-light rounded-3 p-3">
                                    <i class="fas fa-gavel text-gold fa-2x"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Submitted Bids</h6>
                                <h2 class="mb-0 text-gold">{{ $submittedBids }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> +8% from last week
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-gold-light rounded-3 p-3">
                                    <i class="fas fa-user-shield text-gold fa-2x"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Total Admin</h6>
                                <h2 class="mb-0 text-gold">{{ $totalAdmins }}</h2>
                                <small class="text-muted">
                                    {{ $totalAdmins > 1 ? 'Administrators' : 'Administrator' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 text-gray-800">
                                    <i class="fas fa-history text-gold me-2"></i>
                                    Recent Auctions
                                </h5>
                                <p class="text-muted mb-0 small">Latest auction activities and submissions</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.bidding-status.index') }}" class="btn btn-outline-gold btn-sm">
                                    <i class="fas fa-eye me-1"></i> View All
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">
                                            <i class="fas fa-user text-muted me-1"></i>
                                            Bidder Name
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="fas fa-box text-muted me-1"></i>
                                            Product Name
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="fas fa-dollar-sign text-muted me-1"></i>
                                            Starting Price (RM)
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="fas fa-info-circle text-muted me-1"></i>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentAuctions as $auction)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar-sm bg-gold-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <i class="fas fa-user text-gold"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $auction->bidder_name }}</h6>
                                                        <small class="text-muted">Bidder</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div>
                                                    <span class="fw-medium">{{ $auction->product_name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span class="fw-bold text-success">RM
                                                    {{ number_format($auction->starting_price, 2) }}</span>
                                            </td>
                                            <td class="py-3">
                                                @php
                                                    $statusClass = match (strtolower($auction->status)) {
                                                        'active' => 'bg-success',
                                                        'pending' => 'bg-warning',
                                                        'completed' => 'bg-gold',
                                                        'cancelled' => 'bg-danger',
                                                        default => 'bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-2 py-1">
                                                    {{ ucfirst($auction->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p>No recent auctions found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --bs-gold: #B8860B; /* Warna emas yang lebih gelap */
            --bs-gold-rgb: 184, 134, 11;
            --bs-gold-light: rgba(184, 134, 11, 0.1); /* Warna latar belakang yang lebih gelap */
        }

        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .table tbody tr:hover {
            background-color: var(--bs-gold-light);
        }

        .bg-gold {
            background-color: var(--bs-gold) !important;
            color: #fff; /* Teks berwarna putih untuk kontras yang lebih baik */
        }

        .bg-gold-light {
            background-color: var(--bs-gold-light) !important;
        }

        .text-gold {
            color: var(--bs-gold) !important;
        }

        .text-gray-800 {
            color: #5a5c69 !important;
        }

        .btn-outline-gold {
            color: var(--bs-gold);
            border-color: var(--bs-gold);
        }

        .btn-outline-gold:hover {
            color: #fff;
            background-color: var(--bs-gold);
            border-color: var(--bs-gold);
        }
    </style>
@endsection
