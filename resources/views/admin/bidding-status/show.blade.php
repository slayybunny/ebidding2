@extends('layouts.admin.app')

@section('page-title', 'Auction Details')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.bidding-status.index') }}"
                                class="text-decoration-none">Auctions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0 mt-1">Auction Details</h3>
            </div>
            <div>
                <a href="{{ route('admin.bidding-status.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-gavel text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-semibold">{{ $auction->product_name }}</h5>
                                <small class="text-muted">Product Code: {{ $auction->slug }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-info bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="fas fa-user text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-muted">Tender</h6>
                                        <p class="mb-0 fw-medium">{{ $auction->member->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="fas fa-calendar-check text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-muted">Start Date</h6>
                                        <p class="mb-0 fw-medium">
                                            {{ \Carbon\Carbon::parse($auction->start_time)->format('M d, Y') }}</p>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($auction->start_time)->format('h:i A') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="fas fa-calendar-times text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-muted">End Date</h6>
                                        <p class="mb-0 fw-medium">
                                            {{ \Carbon\Carbon::parse($auction->end_time)->format('M d, Y') }}</p>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($auction->end_time)->format('h:i A') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="bg-secondary bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="fas fa-info-circle text-secondary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-muted">Status</h6>
                                        @if ($auction->status === 'upcoming')
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Upcoming
                                            </span>
                                        @elseif ($auction->status === 'active')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-play me-1"></i>Ongoing
                                            </span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-semibold">
                            <i class="fas fa-chart-line text-primary me-2"></i>Auction Statistics
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center p-3 bg-primary bg-opacity-10 rounded-3">
                                    <h4 class="mb-1 text-primary fw-bold">{{ $auction->bids->count() }}</h4>
                                    <small class="text-muted">Total Bids</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-success bg-opacity-10 rounded-3">
                                    <h4 class="mb-1 text-success fw-bold">
                                        @if ($auction->bids->count() > 0)
                                            RM {{ number_format($highestBid->amount, 0) }}
                                        @else
                                            RM 0
                                        @endif
                                    </h4>
                                    <small class="text-muted">Highest Bid</small>
                                </div>
                            </div>
                        </div>

                        @if ($auction->bids->count() > 0)
                            <hr class="my-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 rounded-2 p-2 me-3">
                                    <i class="fas fa-trophy text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Leading Bidder</h6>
                                    <p class="mb-0 fw-medium">
                                        {{ $highestBid->member->name ?? 'Unknown' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-history text-primary me-2"></i>Bidding History
                        </h5>
                        <small class="text-muted">All bids for this auction</small>
                    </div>
                    @if ($auction->bids->count() > 0)
                        <span class="badge bg-primary px-3 py-2">{{ $auction->bids->count() }} Bids</span>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                @if ($auction->bids->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 px-4 py-3">Bil</th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user text-muted me-1"></i>Bidder
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-dollar-sign text-muted me-1"></i>Bid Amount
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-clock text-muted me-1"></i>Time
                                    </th>
                                    <th class="border-0 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($auction->bids->sortByDesc('amount') as $index => $bid)
                                    <tr>
                                        <td class="px-4 py-3">
                                            @if ($index === 0)
                                                <i class="fas fa-crown text-warning"></i>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2">
                                                    <i class="fas fa-user text-primary"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-medium">{{ $bid->member->name ?? 'Unknown' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <span class="fw-bold text-success fs-5">RM
                                                {{ number_format($bid->amount, 2) }}</span>
                                        </td>
                                        <td class="py-3">
                                            <div>
                                                <span
                                                    class="fw-medium">{{ \Carbon\Carbon::parse($bid->created_at)->format('M d, Y') }}</span><br>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($bid->created_at)->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center">
                                            @if ($index === 0)
                                                <span class="badge bg-success px-2 py-1">
                                                    <i class="fas fa-medal me-1"></i>Leading
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark px-2 py-1">Outbid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-gavel text-muted fa-2x"></i>
                        </div>
                        <h5 class="text-muted mb-2">No Bids Yet</h5>
                        <p class="text-muted mb-0">This auction hasn't received any bids yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
        }

        .card {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }

        .badge {
            font-size: 0.85rem;
        }
    </style>
@endsection
