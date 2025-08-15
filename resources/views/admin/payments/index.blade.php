@extends('layouts.admin.app')

@section('title', 'Rekod Pembayaran')
@section('page-title', 'PAYMENT RECORDS')

@section('content')
    <style>
        .gov-header {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 0;
        }

        .gov-header h4 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .gov-header .header-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-right: 15px;
        }

        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #daa520;
        }

        .info-card h6 {
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-card .value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .gov-table-container {
            background: white;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .table-controls {
            background: #f8fafc;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            padding: 8px 16px 8px 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }

        .gov-table {
            margin: 0;
            font-size: 14px;
        }

        .gov-table thead {
            background: #f1f5f9;
            color: #374151;
        }

        .gov-table th {
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
            border: none;
            border-bottom: 2px solid #e5e7eb;
        }

        .gov-table td {
            padding: 16px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        .gov-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-failed {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .amount-cell {
            font-weight: 700;
            color: #059669;
        }

        .pagination-wrapper {
            background: #f8fafc;
            padding: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .export-btn {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .export-btn:hover {
            color: white;
            transform: translateY(-1px);
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #b8860b, #daa520);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .text-primary-custom {
            color: #b8860b !important;
        }
    </style>

    <div class="container-fluid mt-4">
        <div class="gov-header">
            <h4>
                <div class="header-icon">
                    <i class="fas fa-credit-card fa-lg"></i>
                </div>
                Rekod Pembayaran eBidding
                <span class="ms-auto badge bg-light text-dark">
                    <i class="fas fa-database me-1"></i>
                    5 Rekod
                </span>
            </h4>
        </div>

        <div class="info-cards mt-4">
            <div class="info-card">
                <h6>Jumlah Keseluruhan</h6>
                <div class="value text-success">RM 1,826.25</div>
            </div>
            <div class="info-card">
                <h6>Pembayaran Berjaya</h6>
                <div class="value text-success">3</div>
            </div>
            <div class="info-card">
                <h6>Pembayaran Tertangguh</h6>
                <div class="value text-warning">1</div>
            </div>
            <div class="info-card">
                <h6>Pembayaran Gagal</h6>
                <div class="value text-danger">1</div>
            </div>
        </div>

        <div class="gov-table-container">
            <div class="table-controls">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="Cari nama pengguna...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="filter-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="Selesai">Berjaya</option>
                            <option value="Pending">Tertangguh</option>
                            <option value="Gagal">Gagal</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="filter-select" id="methodFilter">
                            <option value="">Semua Kaedah</option>
                            <option value="online banking">Online Banking</option>
                            <option value="credit card">Credit Card</option>
                            <option value="fpx">FPX</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="export-btn">
                            <i class="fas fa-download me-2"></i>Export
                        </button>
                    </div>
                </div>
            </div>

            <table class="table gov-table" id="paymentTable">
                <thead>
                    <tr>
                        <th width="5%">Bil</th>
                        <th width="25%">Nama Pengguna</th>
                        <th width="15%">Jumlah (RM)</th>
                        <th width="15%">Kaedah Bayaran</th>
                        <th width="20%">Tarikh & Masa</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Ganti data di bawah dengan loop dari pangkalan data --}}
                    {{-- Contoh data mockup: --}}
                    <tr data-status="Selesai" data-method="online banking" data-user="Ali Bin Ahmad">
                        <td class="text-center fw-bold">01</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">A</div>
                                <div>
                                    <div class="fw-semibold">Ali Bin Ahmad</div>
                                    <div class="text-muted small">Pengguna Berdaftar</div>
                                </div>
                            </div>
                        </td>
                        <td class="amount-cell">550.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-2 text-primary-custom"></i>
                                Online Banking
                            </div>
                        </td>
                        <td>
                            <div>23/05/2025</div>
                            <div class="text-muted small">10:23:00</div>
                        </td>
                        <td>
                            <span class="status-badge status-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr data-status="Pending" data-method="credit card" data-user="Siti Zarina Binti Omar">
                        <td class="text-center fw-bold">02</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">S</div>
                                <div>
                                    <div class="fw-semibold">Siti Zarina Binti Omar</div>
                                    <div class="text-muted small">Pengguna Berdaftar</div>
                                </div>
                            </div>
                        </td>
                        <td class="amount-cell">320.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-2 text-primary-custom"></i>
                                Credit Card
                            </div>
                        </td>
                        <td>
                            <div>01/06/2025</div>
                            <div class="text-muted small">11:45:12</div>
                        </td>
                        <td>
                            <span class="status-badge status-pending">
                                <i class="fas fa-clock me-1"></i>
                                Pending
                            </span>
                        </td>
                    </tr>

                    <tr data-status="Gagal" data-method="online banking" data-user="Muthu Kumar A/L Raman">
                        <td class="text-center fw-bold">03</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">M</div>
                                <div>
                                    <div class="fw-semibold">Muthu Kumar A/L Raman</div>
                                    <div class="text-muted small">Pengguna Berdaftar</div>
                                </div>
                            </div>
                        </td>
                        <td class="amount-cell">230.00</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-2 text-primary-custom"></i>
                                Online Banking
                            </div>
                        </td>
                        <td>
                            <div>01/08/2025</div>
                            <div class="text-muted small">13:10:00</div>
                        </td>
                        <td>
                            <span class="status-badge status-failed">
                                <i class="fas fa-times-circle me-1"></i>
                                Gagal
                            </span>
                        </td>
                    </tr>

                    <tr data-status="Selesai" data-method="credit card" data-user="Fatimah Binti Hassan">
                        <td class="text-center fw-bold">04</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">F</div>
                                <div>
                                    <div class="fw-semibold">Fatimah Binti Hassan</div>
                                    <div class="text-muted small">Pengguna Berdaftar</div>
                                </div>
                            </div>
                        </td>
                        <td class="amount-cell">450.50</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-2 text-primary-custom"></i>
                                Credit Card
                            </div>
                        </td>
                        <td>
                            <div>02/08/2025</div>
                            <div class="text-muted small">09:15:30</div>
                        </td>
                        <td>
                            <span class="status-badge status-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr data-status="Selesai" data-method="fpx" data-user="Lim Wei Ming">
                        <td class="text-center fw-bold">05</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">L</div>
                                <div>
                                    <div class="fw-semibold">Lim Wei Ming</div>
                                    <div class="text-muted small">Pengguna Berdaftar</div>
                                </div>
                            </div>
                        </td>
                        <td class="amount-cell">275.75</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-credit-card me-2 text-primary-custom"></i>
                                FPX
                            </div>
                        </td>
                        <td>
                            <div>03/08/2025</div>
                            <div class="text-muted small">14:20:45</div>
                        </td>
                        <td>
                            <span class="status-badge status-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Selesai
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination-wrapper">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">Menunjukkan 1 hingga 5 daripada 5 rekod</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <nav aria-label="Navigasi halaman">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Seterusnya</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-box input');
            const statusFilter = document.getElementById('statusFilter');
            const methodFilter = document.getElementById('methodFilter');
            const tableRows = document.querySelectorAll('#paymentTable tbody tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedMethod = methodFilter.value.toLowerCase();

                let visibleRowsCount = 0;

                tableRows.forEach(row => {
                    // Ambil nama pengguna dari atribut data-user
                    const userName = row.dataset.user.toLowerCase();
                    const statusText = row.dataset.status.toLowerCase();
                    const paymentMethodText = row.dataset.method.toLowerCase();

                    const isSearchMatch = userName.includes(searchTerm);
                    const isStatusMatch = selectedStatus === '' || statusText === selectedStatus;
                    const isMethodMatch = selectedMethod === '' || paymentMethodText === selectedMethod;

                    if (isSearchMatch && isStatusMatch && isMethodMatch) {
                        row.style.display = '';
                        visibleRowsCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            methodFilter.addEventListener('change', filterTable);
        });
    </script>
@endsection
