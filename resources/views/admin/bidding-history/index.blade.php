@extends('layouts.admin.app')

@section('page-title', 'BIDDING HISTORY')

@section('content')
    <div class="container-fluid mt-4">
        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-4 border-0" id="biddingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids" type="button"
                    role="tab">
                    <i class="fas fa-gavel me-1"></i> Bid History
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button"
                    role="tab">
                    <i class="fas fa-user-clock me-1"></i> Login History
                </button>
            </li>
        </ul>

        <div class="tab-content" id="biddingTabsContent">
            {{-- TAB: Bid History --}}
            <div class="tab-pane fade show active" id="bids" role="tabpanel">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom d-flex align-items-center">
                        <i class="fas fa-list-ul me-2 text-primary"></i>
                        <h5 class="mb-0 fw-semibold text-dark">Bidding Records</h5>
                    </div>
                    <div class="card-body bg-light bg-opacity-10">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom">
                                    <tr class="small text-uppercase text-muted">
                                        <th class="py-3 px-3">Bil</th>
                                        <th class="py-3 px-3 text-nowrap"><i class="fas fa-user me-1"></i>Bidder</th>
                                        <th class="py-3 px-3 text-end text-nowrap"><i class="fas fa-coins me-1"></i>Amount
                                        </th>
                                        <th class="py-3 px-3 text-nowrap"><i class="fas fa-clock me-1"></i>Time</th>
                                        <th class="py-3 px-3 text-nowrap">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through the bidding records from the database --}}
                                    @foreach ($biddingRecords as $index => $bid)
                                        <tr>
                                            <td class="px-3">{{ $index + 1 }}</td>
                                            {{-- Mengakses nama dari hubungan 'member' --}}
                                            <td class="px-3">{{ $bid->member->name ?? 'N/A' }}</td>
                                            {{-- Menggunakan medan 'bid_price' --}}
                                            <td class="px-3 text-end">RM {{ number_format($bid->bid_price, 2) }}</td>
                                            <td class="px-3 text-nowrap">
                                                {{ \Carbon\Carbon::parse($bid->created_at)->format('Y-m-d H:i:s') }}</td>
                                            <td class="px-3">
                                                {{-- **MODIFIED SECTION: Displaying the raw status from the database** --}}
                                                @php
                                                    $statusClass = '';
                                                    switch ($bid->status) {
                                                        case 'winner':
                                                            $statusClass =
                                                                'bg-success-subtle text-success border border-success-subtle';
                                                            break;
                                                        case 'lose':
                                                            $statusClass =
                                                                'bg-danger-subtle text-danger border border-danger-subtle';
                                                            break;
                                                        case 'pending':
                                                            $statusClass =
                                                                'bg-secondary-subtle text-secondary border border-secondary-subtle';
                                                            break;
                                                        default:
                                                            $statusClass =
                                                                'bg-info-subtle text-info border border-info-subtle';
                                                    }
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ ucwords($bid->status) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB: Login History (Unchanged) --}}
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-history me-2 text-primary"></i>
                            <h5 class="mb-0 fw-semibold text-dark">Login History Records</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="text-muted me-2 d-none d-md-block">Filter by Role:</small>
                            <select id="filterRole" class="form-select form-select-sm w-auto"
                                onchange="filterLoginHistory()">
                                <option value="all">All Roles</option>
                                <option value="admin">Admin Only</option>
                                <option value="user">User Only</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 login-history-table">
                                <thead class="table-light">
                                    <tr class="small text-uppercase text-muted fw-semibold">
                                        <th class="py-3 px-3 border-0">Bil</th>
                                        <th class="py-3 px-3 border-0"><i class="fas fa-user me-1 text-primary"></i>User
                                            Details</th>
                                        <th class="py-3 px-3 border-0 text-nowrap"><i
                                                class="fas fa-map-marker-alt me-1 text-primary"></i>IP Address</th>
                                        <th class="py-3 px-3 border-0"><i
                                                class="fas fa-desktop me-1 text-primary"></i>Device / Browser</th>
                                        <th class="py-3 px-3 border-0 text-nowrap"><i
                                                class="fas fa-calendar-alt me-1 text-primary"></i>Login Time</th>
                                        <th class="px-3 py-3 border-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loginLogs as $index => $log)
                                        <tr data-role="{{ $log->admin ? 'admin' : ($log->user ? 'user' : 'unknown') }}"
                                            class="login-row">
                                            <td class="px-3 py-3">
                                                <span class="text-muted fw-semibold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="px-3 py-3">
                                                <div class="d-flex align-items-center">
                                                    @if ($log->admin)
                                                        <div class="avatar-circle bg-warning-subtle me-3"><i
                                                                class="fas fa-user-shield text-warning"></i></div>
                                                        <div>
                                                            <div class="fw-semibold text-dark">
                                                                {{ $log->admin->name ?? 'Administrator' }}</div>
                                                            <span class="badge bg-warning text-dark px-2 py-1"><i
                                                                    class="fas fa-crown me-1"></i>Administrator</span>
                                                        </div>
                                                    @elseif ($log->user)
                                                        <div class="avatar-circle bg-info-subtle me-3"><i
                                                                class="fas fa-user text-info"></i></div>
                                                        <div>
                                                            <div class="fw-semibold text-dark">
                                                                {{ $log->user->name ?? trim(($log->user->first_name ?? '') . ' ' . ($log->user->last_name ?? '')) ?: 'Member User' }}
                                                            </div>
                                                            <span class="badge bg-info text-white px-2 py-1"><i
                                                                    class="fas fa-user me-1"></i>Member</span>
                                                        </div>
                                                    @else
                                                        <div class="avatar-circle bg-secondary-subtle me-3"><i
                                                                class="fas fa-question text-secondary"></i></div>
                                                        <div>
                                                            <div class="fw-semibold text-muted">Unknown User</div>
                                                            <span class="badge bg-secondary px-2 py-1"><i
                                                                    class="fas fa-exclamation me-1"></i>Unknown</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-3 py-3">
                                                <div class="ip-badge d-inline-block">
                                                    <i class="fas fa-globe me-1 text-muted"></i>
                                                    <span class="fw-mono">{{ $log->ip_address }}</span>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3">
                                                <div class="device-info">
                                                    <i class="fas fa-laptop me-2 text-muted"></i>
                                                    <span class="text-dark">{{ $log->device ?? 'Unknown Device' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3 text-nowrap">
                                                <div class="time-info">
                                                    <div class="fw-semibold text-dark">
                                                        {{ \Carbon\Carbon::parse($log->login_time)->timezone('Asia/Kuala_Lumpur')->format('d M Y') }}
                                                    </div>
                                                    <small class="text-muted"><i
                                                            class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($log->login_time)->timezone('Asia/Kuala_Lumpur')->format('H:i:s') }}</small>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer bg-light border-top">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users me-2 text-primary"></i>
                                    <small class="text-muted">Total Records: <strong
                                            id="totalRecordsCount">{{ count($loginLogs) }}</strong></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user-shield me-2 text-warning"></i>
                                    <small class="text-muted">Admin Logins: <strong id="adminCount">0</strong></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user me-2 text-info"></i>
                                    <small class="text-muted">User Logins: <strong id="userCount">0</strong></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterLoginHistory() {
            const selectedRole = document.getElementById('filterRole').value;
            const rows = document.querySelectorAll('#login tbody tr.login-row');
            let adminCount = 0;
            let userCount = 0;
            let totalVisibleRecords = 0;

            rows.forEach(row => {
                const role = row.getAttribute('data-role');

                if (selectedRole === 'all' || role === selectedRole) {
                    row.style.display = '';
                    totalVisibleRecords++;

                    if (role === 'admin') adminCount++;
                    else if (role === 'user') userCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('adminCount').textContent = adminCount;
            document.getElementById('userCount').textContent = userCount;

            const totalRecordsElement = document.getElementById('totalRecordsCount');
            totalRecordsElement.textContent = totalVisibleRecords;
        }

        document.addEventListener('DOMContentLoaded', function() {
            filterLoginHistory();
            document.getElementById('filterRole').value = 'all';
        });
    </script>

    <style>
        /* Tab Styling */
        .nav-tabs .nav-link.active {
            background-color: #D4AF37;
            color: white;
            font-weight: bold;
            border: none;
        }

        .nav-tabs .nav-link {
            border-radius: 0.5rem 0.5rem 0 0;
            font-weight: 500;
            color: #555;
            border: none;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(212, 175, 55, 0.1);
            color: #D4AF37;
        }

        /* Card Styling */
        .card {
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .card-header {
            border-radius: 16px 16px 0 0;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        /* Login History Table Styling */
        .login-history-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .login-history-table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 0.75rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .login-row {
            transition: all 0.3s ease;
            opacity: 1;
            transform: translateY(0);
        }

        .login-row:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.05) 0%, rgba(255, 255, 255, 0.8) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Avatar Circle */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.15);
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.15);
        }

        .bg-secondary-subtle {
            background-color: rgba(108, 117, 125, 0.15);
        }

        /* Badge Styling */
        .badge {
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* IP Badge */
        .ip-badge {
            background: rgba(108, 117, 125, 0.1);
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
        }

        .fw-mono {
            font-family: 'Courier New', monospace;
        }

        /* Device Info */
        .device-info {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        /* Time Info */
        .time-info {
            text-align: left;
        }

        /* Success/Error states */
        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .text-success {
            color: #198754 !important;
        }

        .border-success-subtle {
            border-color: rgba(25, 135, 84, 0.3) !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        .border-secondary-subtle {
            border-color: rgba(108, 117, 125, 0.3) !important;
        }

        .bg-danger-subtle {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .border-danger-subtle {
            border-color: rgba(220, 53, 69, 0.3) !important;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-header>div:last-child {
                margin-top: 1rem;
                width: 100%;
            }

            .avatar-circle {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .login-history-table {
                font-size: 0.85rem;
            }
        }

        /* Table Footer */
        .card-footer {
            border-radius: 0 0 16px 16px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 1rem 1.5rem;
        }

        /* Filter Select Styling */
        .form-select-sm {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-select-sm:focus {
            border-color: #D4AF37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }
    </style>
@endsection
