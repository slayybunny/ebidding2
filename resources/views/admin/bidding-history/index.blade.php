@extends('layouts.admin.app')

@section('page-title', 'BIDDING HISTORY')

@section('content')
<div class="container-fluid mt-4">
    <!-- Tab Header -->
    <ul class="nav nav-tabs mb-4 border-0" id="biddingTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids" type="button" role="tab">
                <i class="fas fa-gavel me-1"></i> Bid History
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                <i class="fas fa-user-clock me-1"></i> Login History
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="biddingTabsContent">
        <!-- Tab 1: Bidding Records -->
        <div class="tab-pane fade show active" id="bids" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom d-flex align-items-center">
                    <i class="fas fa-list-ul me-2 text-primary"></i>
                    <h5 class="mb-0 fw-semibold text-dark">Sample Bidding Records</h5>
                </div>
                <div class="card-body bg-light bg-opacity-10">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light border-bottom">
                            <tr class="small text-uppercase text-muted">
                                <th>Bil</th>
                                <th><i class="fas fa-user me-1"></i>Bidder</th>
                                <th><i class="fas fa-box me-1"></i>Product</th>
                                <th class="text-end"><i class="fas fa-coins me-1"></i>Amount</th>
                                <th><i class="fas fa-clock me-1"></i>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ali Bin Abu</td>
                                <td>Gold Bar 100g</td>
                                <td class="text-end">RM 18,900.00</td>
                                <td>2025-07-30 10:12:33</td>
                                <td><span class="badge bg-success-subtle text-success border border-success-subtle">Winning</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Fatimah Yusuf</td>
                                <td>Gold Bar 50g</td>
                                <td class="text-end">RM 15,000.00</td>
                                <td>2025-07-30 10:10:20</td>
                                <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Outbid</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab 2: Login History -->
        <div class="tab-pane fade" id="login" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom d-flex align-items-center">
                    <i class="fas fa-user-clock me-2 text-warning"></i>
                    <h5 class="mb-0 fw-semibold text-dark">Recent Login History</h5>
                </div>
                <div class="card-body bg-light bg-opacity-10">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light border-bottom">
                            <tr class="small text-uppercase text-muted">
                                <th>Bil</th>
                                <th><i class="fas fa-user me-1"></i>User</th>
                                <th><i class="fas fa-network-wired me-1"></i>IP Address</th>
                                <th><i class="fas fa-laptop me-1"></i>Device / Browser</th>
                                <th><i class="fas fa-clock me-1"></i>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ali Bin Abu</td>
                                <td>192.168.1.10</td>
                                <td>Chrome on Windows 10</td>
                                <td>2025-07-30 09:50:14</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Fatimah Yusuf</td>
                                <td>192.168.1.15</td>
                                <td>Safari on iPhone</td>
                                <td>2025-07-30 09:32:02</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Ahmad Farid</td>
                                <td>192.168.1.20</td>
                                <td>Firefox on Ubuntu</td>
                                <td>2025-07-29 21:18:44</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link.active {
        background-color: #D4AF37;
        color: white;
        font-weight: bold;
    }

    .nav-tabs .nav-link {
        border-radius: 0.5rem 0.5rem 0 0;
        font-weight: 500;
        color: #555;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.75em;
        border-radius: 1rem;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-secondary-subtle {
        background-color: rgba(108, 117, 125, 0.1);
    }

    .text-success {
        color: #198754 !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .border-success-subtle {
        border-color: rgba(25, 135, 84, 0.3) !important;
    }

    .border-secondary-subtle {
        border-color: rgba(108, 117, 125, 0.3) !important;
    }
</style>
@endsection
