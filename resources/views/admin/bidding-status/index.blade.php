@extends('layouts.admin.app')

@section('page-title', 'BIDDING STATUS')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body px-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-semibold text-dark mb-0">
                    <i class="fas fa-gavel me-2 text-primary"></i>Status Lelongan
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="border-bottom text-muted small text-uppercase">
                        <tr>
                            <th>Bil</th>
                            <th>Produk</th>
                            <th>Tarikh Mula</th>
                            <th>Tarikh Tamat</th>
                            <th>Status</th>
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Dummy Data --}}
                        <tr class="bg-white shadow-sm rounded-3 mb-2">
                            <td>1</td>
                            <td>
                                <div class="fw-semibold">Gold Bar 100g</div>
                                <small class="text-muted">Kod: GB100-001</small>
                            </td>
                            <td>2025-08-01 10:00 AM</td>
                            <td>2025-08-01 12:00 PM</td>
                            <td>
                                <span class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">
                                    <i class="fas fa-clock me-1"></i> Akan Bermula
                                </span>
                            </td>
                            <td class="text-center">
                            <a href="{{ route('admin.bidding-status.show', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i> Lihat
                            </a>
                            </td>
                        </tr>

                        <tr class="bg-white shadow-sm rounded-3 mb-2">
                            <td>2</td>
                            <td>
                                <div class="fw-semibold">Gold Coin 50g</div>
                                <small class="text-muted">Kod: GC50-002</small>
                            </td>
                            <td>2025-07-31 09:00 AM</td>
                            <td>2025-07-31 05:00 PM</td>
                            <td>
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                    <i class="fas fa-play me-1"></i> Sedang Berlangsung
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.bidding-status.show', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                            </td>
                        </tr>

                        <tr class="bg-white shadow-sm rounded-3">
                            <td>3</td>
                            <td>
                                <div class="fw-semibold">Gold Bar 250g</div>
                                <small class="text-muted">Kod: GB250-003</small>
                            </td>
                            <td>2025-07-30 02:00 PM</td>
                            <td>2025-07-30 04:00 PM</td>
                            <td>
                                <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Telah Tamat
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>
                                    <i class="fas fa-ban me-1"></i> Tamat
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        background-color: #fff;
    }

    .badge {
        font-size: 0.75rem;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table thead th {
        font-weight: 600;
    }

    .btn-sm {
        font-size: 0.75rem;
    }

    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-secondary-subtle {
        background-color: rgba(108, 117, 125, 0.1);
    }

    .bg-danger-subtle {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .text-success {
        color: #198754 !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .border-success-subtle {
        border-color: rgba(25, 135, 84, 0.2) !important;
    }

    .border-secondary-subtle {
        border-color: rgba(108, 117, 125, 0.2) !important;
    }

    .border-danger-subtle {
        border-color: rgba(220, 53, 69, 0.2) !important;
    }
</style>
@endsection
