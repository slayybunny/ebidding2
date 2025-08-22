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
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list-ul me-2 text-custom-brown-dark"></i>
                            <h5 class="mb-0 fw-semibold text-dark">Bidding Records</h5>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            {{-- Tambahkan filter status di sini --}}
                            <small class="text-muted d-none d-md-block">Filter by Status:</small>
                            <select id="filterBidStatus" class="form-select form-select-sm w-auto"
                                onchange="filterBidHistory()">
                                <option value="all">All Status</option>
                                <option value="winner">Winner Only</option>
                                <option value="lose">Lose Only</option>
                                <option value="pending">Pending Only</option>
                            </select>
                            {{-- Tombol untuk Bid History --}}
                            <button class="btn btn-sm btn-outline-custom-brown" onclick="printReport('bids')">
                                <i class="fas fa-print me-1"></i> Print
                            </button>
                            <button class="btn btn-sm btn-custom-brown" onclick="downloadReport('bids')">
                                <i class="fas fa-download me-1"></i> Download
                            </button>
                        </div>
                    </div>
                    <div class="card-body bg-light bg-opacity-10">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="bidsTable">
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
                                        <tr data-status="{{ $bid->status }}">
                                            <td class="px-3">{{ $index + 1 }}</td>
                                            {{-- Mengakses nama dari hubungan 'member' --}}
                                            <td class="px-3">{{ $bid->member->name ?? 'N/A' }}</td>
                                            {{-- Menggunakan medan 'bid_price' --}}
                                            <td class="px-3 text-end">RM {{ number_format($bid->bid_price, 2) }}</td>
                                            <td class="px-3 text-nowrap">
                                                {{ \Carbon\Carbon::parse($bid->created_at)->format('Y-m-d H:i:s') }}</td>
                                            <td class="px-3">
                                                @php
                                                    $statusClass = '';
                                                    switch ($bid->status) {
                                                        case 'winner':
                                                            $statusClass = 'bg-success-subtle text-success border border-success-subtle';
                                                            break;
                                                        case 'lose':
                                                            $statusClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                                                            break;
                                                        case 'pending':
                                                            $statusClass = 'bg-secondary-subtle text-secondary border border-secondary-subtle';
                                                            break;
                                                        default:
                                                            $statusClass = 'bg-info-subtle text-info border border-info-subtle';
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

            {{-- TAB: Login History --}}
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-history me-2 text-custom-brown-dark"></i>
                            <h5 class="mb-0 fw-semibold text-dark">Login History Records</h5>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted d-none d-md-block">Filter by Role:</small>
                            <select id="filterRole" class="form-select form-select-sm w-auto"
                                onchange="filterLoginHistory()">
                                <option value="all">All Roles</option>
                                <option value="admin">Admin Only</option>
                                <option value="user">User Only</option>
                            </select>
                            {{-- Tombol untuk Login History --}}
                            <button class="btn btn-sm btn-outline-custom-brown" onclick="printReport('login')">
                                <i class="fas fa-print me-1"></i> Print
                            </button>
                            <button class="btn btn-sm btn-custom-brown" onclick="downloadReport('login')">
                                <i class="fas fa-download me-1"></i> Download
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 login-history-table" id="loginTable">
                                <thead class="table-light">
                                    <tr class="small text-uppercase text-muted fw-semibold">
                                        <th class="py-3 px-3 border-0">Bil</th>
                                        <th class="py-3 px-3 border-0"><i class="fas fa-user me-1 text-custom-brown-dark"></i>User
                                            Details</th>
                                        <th class="py-3 px-3 border-0 text-nowrap"><i
                                                class="fas fa-map-marker-alt me-1 text-custom-brown-dark"></i>IP Address</th>
                                        <th class="py-3 px-3 border-0"><i
                                                class="fas fa-desktop me-1 text-custom-brown-dark"></i>Device / Browser</th>
                                        <th class="py-3 px-3 border-0 text-nowrap"><i
                                                class="fas fa-calendar-alt me-1 text-custom-brown-dark"></i>Login Time</th>
                                        <th class="px-3 py-3 border-0 text-end">Actions</th> {{-- Kolom Aksi --}}
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
                                            <td class="px-3 py-3 text-end">
                                                {{-- Form untuk menghapus log --}}
                                                <form action="{{ route('admin.login-log.destroy', $log->id) }}" method="POST"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus catatan login ini?');"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger-subtle text-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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
                                    <i class="fas fa-users me-2 text-custom-brown-dark"></i>
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

    {{-- Script untuk fungsi JavaScript --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function filterBidHistory() {
            const selectedStatus = document.getElementById('filterBidStatus').value;
            const rows = document.querySelectorAll('#bids tbody tr');
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (selectedStatus === 'all' || status === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

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
            
            // Tambahkan ini untuk memanggil fungsi filterBidHistory saat halaman dimuat
            filterBidHistory();
            document.getElementById('filterBidStatus').value = 'all';
        });

        function printReport(tableId) {
            const table = document.getElementById(tableId + 'Table').cloneNode(true);
            const tableTitle = tableId === 'bids' ? 'Bidding Records' : 'Login History Records';

            // Remove the 'Actions' column from the table to be printed
            const headerRow = table.querySelector('thead tr');
            const headers = headerRow.querySelectorAll('th');
            let actionColumnIndex = -1;
            headers.forEach((header, index) => {
                if (header.textContent.trim() === 'Actions') {
                    actionColumnIndex = index;
                }
            });

            if (actionColumnIndex !== -1) {
                headers[actionColumnIndex].remove();
                table.querySelectorAll('tbody tr').forEach(row => {
                    row.querySelectorAll('td')[actionColumnIndex].remove();
                });
            }

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>${tableTitle} Report</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        h1 { text-align: center; color: #333; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h1>${tableTitle} Report</h1>
                    ${table.outerHTML}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function downloadReport(tableId) {
            const table = document.getElementById(tableId + 'Table');
            let tableName = tableId === 'bids' ? 'Bidding_Records' : 'Login_History_Records';
            let filename = tableName + '_' + new Date().toLocaleDateString('en-CA') + '.xlsx';

            // Clone the table to manipulate without affecting the original display
            const clonedTable = table.cloneNode(true);

            // Remove 'Actions' column from the cloned table
            const headerRow = clonedTable.querySelector('thead tr');
            let actionColumnIndex = -1;
            headerRow.querySelectorAll('th').forEach((th, index) => {
                if (th.textContent.trim() === 'Actions') {
                    actionColumnIndex = index;
                }
            });
            if (actionColumnIndex !== -1) {
                clonedTable.querySelectorAll('th')[actionColumnIndex].remove();
                clonedTable.querySelectorAll('tr').forEach(row => {
                    if (row.children[actionColumnIndex]) {
                        row.children[actionColumnIndex].remove();
                    }
                });
            }

            const wb = XLSX.utils.table_to_book(clonedTable, { sheet: "Sheet1" });
            XLSX.writeFile(wb, filename);
        }
    </script>
    <style>
        /* Definisi warna kustom */
        :root {
            --custom-brown-dark: #A57C4F;
            --custom-brown: #B78D5B;
            --custom-brown-light: #CFB79A;
            --custom-brown-subtle: rgba(183, 141, 91, 0.15);
            --gradient-start: #D8A561;
            --gradient-end: #A57C4F;
        }

        /* Mengganti warna primary dengan golden brown */
        .text-custom-brown-dark {
            color: var(--custom-brown-dark) !important;
        }

        .btn-custom-brown {
            color: white;
            background-image: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(183, 141, 91, 0.3);
            transition: all 0.3s ease;
        }

        .btn-custom-brown:hover {
            box-shadow: 0 6px 20px rgba(183, 141, 91, 0.5);
            transform: translateY(-2px);
            background-position: right center;
        }

        /* Tombol Outline */
        .btn-outline-custom-brown {
            color: var(--custom-brown-dark);
            border-color: var(--custom-brown-dark);
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-custom-brown:hover {
            background-color: var(--custom-brown);
            color: white;
            border-color: var(--custom-brown);
        }
        
        .form-select-sm:focus {
            border-color: var(--custom-brown);
            box-shadow: 0 0 0 0.2rem rgba(183, 141, 91, 0.25);
        }

        /* Tabs */
        .nav-tabs .nav-link.active {
            color: white;
            font-weight: bold;
            border: none;
            background-image: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            box-shadow: 0 4px 15px rgba(183, 141, 91, 0.3);
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: var(--custom-brown-subtle);
            color: var(--custom-brown-dark);
        }

        /* Header Card */
        .card-header .text-custom-brown-dark {
            color: var(--custom-brown-dark) !important;
        }

        /* Sisa styling sebelumnya tidak berubah */
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
            background: linear-gradient(135deg, rgba(183, 141, 91, 0.05) 0%, rgba(255, 255, 255, 0.8) 100%);
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
    </style>
@endsection