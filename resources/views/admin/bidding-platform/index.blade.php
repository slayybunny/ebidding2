@extends('layouts.admin.app')

@section('title', 'Platform Bidding')
@section('page-title', 'PLATFORM BIDDING')

@section('content')
<div class="container-fluid">
    <!-- Official Header -->
    <div class="official-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="header-content">
                    <h1 class="page-title mb-1">SISTEM PENGURUSAN BIDAAN</h1>
                    <div class="subtitle">
                        <span class="value">Platform Bidding Digital Malaysia</span>
                    </div>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb custom-breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Laman Utama</a></li>
                            <li class="breadcrumb-item active">Senarai Bidaan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="header-stats">
                    <div class="stat-item">
                        <span class="stat-label">Tarikh Sistem:</span>
                        <span class="stat-value">{{ date('d/m/Y') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Masa:</span>
                        <span class="stat-value">{{ date('H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            @php
                use Carbon\Carbon;
                $now = Carbon::now();

                $biddings = [
                    ['id' => 1, 'title' => 'Emas 999 10g', 'start_time' => '2025-08-07 10:00:00', 'end_time' => '2025-08-10 10:00:00'], // BERJALAN
                    ['id' => 2, 'title' => 'Emas 916 5g', 'start_time' => '2025-07-15 09:00:00', 'end_time' => '2025-07-16 09:00:00'], // SELESAI
                    ['id' => 3, 'title' => 'Emas 999 20g Premium', 'start_time' => '2025-08-12 14:00:00', 'end_time' => '2025-08-13 14:00:00'], // MENUNGGU
                    ['id' => 4, 'title' => 'Emas 916 15g', 'start_time' => '2025-08-08 09:00:00', 'end_time' => '2025-08-11 18:00:00'], // BERJALAN
                    ['id' => 5, 'title' => 'Emas 999 5g Limited Edition', 'start_time' => '2025-07-20 12:00:00', 'end_time' => '2025-07-21 12:00:00'], // SELESAI
                    ['id' => 6, 'title' => 'Emas 999 50g VIP', 'start_time' => '2025-08-15 10:00:00', 'end_time' => '2025-08-16 16:00:00'], // MENUNGGU
                ];
            @endphp

            <!-- Main Table Section -->
            <div class="official-section">
                <div class="section-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="section-title">SENARAI SESI BIDAAN RASMI</h3>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="table-info">
                                <span class="info-label">Jumlah Rekod:</span>
                                <span class="info-value">{{ count($biddings) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-content p-0">
                    <div class="table-container">
                        <table class="table table-government mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 8%;">BIL.</th>
                                    <th style="width: 25%;">NAMA PRODUK</th>
                                    <th class="text-center" style="width: 18%;">TARIKH MULA</th>
                                    <th class="text-center" style="width: 18%;">TARIKH TAMAT</th>
                                    <th class="text-center" style="width: 15%;">STATUS</th>
                                    <th class="text-center" style="width: 16%;">TINDAKAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($biddings as $index => $bidding)
                                    @php
                                        $start = Carbon::parse($bidding['start_time']);
                                        $end = Carbon::parse($bidding['end_time']);
                                        $statusClass = '';
                                        $statusText = '';
                                        $statusIcon = '';

                                        if ($now->lt($start)) {
                                            $statusClass = 'status-pending';
                                            $statusText = 'MENUNGGU';
                                            $statusIcon = 'fas fa-clock';
                                        } elseif ($now->between($start, $end)) {
                                            $statusClass = 'status-ongoing';
                                            $statusText = 'BERJALAN';
                                            $statusIcon = 'fas fa-play-circle';
                                        } else {
                                            $statusClass = 'status-ended';
                                            $statusText = 'SELESAI';
                                            $statusIcon = 'fas fa-check-circle';
                                        }
                                    @endphp

                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <div class="product-name">{{ strtoupper($bidding['title']) }}</div>
                                                <div class="product-code">
                                                    Kod: BID{{ str_pad($bidding['id'], 4, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="date-info">
                                                <div class="date-main">{{ $start->format('d/m/Y') }}</div>
                                                <div class="date-time">{{ $start->format('H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="date-info">
                                                <div class="date-main">{{ $end->format('d/m/Y') }}</div>
                                                <div class="date-time">{{ $end->format('H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="status-badge {{ $statusClass }}">
                                                <i class="{{ $statusIcon }}"></i>
                                                <span>{{ $statusText }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.bidding.show', $bidding['id']) }}" 
                                               class="btn btn-government btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                LIHAT
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center no-data">
                                            <div class="no-data-content">
                                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                                <div>TIADA REKOD BIDAAN DIJUMPAI</div>
                                                <small class="text-muted">Sila hubungi pentadbir sistem untuk maklumat lanjut</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer Information -->
            <div class="footer-info mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <h6 class="info-title">NOTA PENTING:</h6>
                            <ul class="info-list">
                                <li>Semua masa yang dipaparkan adalah mengikut Waktu Malaysia (GMT +8)</li>
                                <li>Status bidaan dikemaskini secara automatik mengikut masa sistem</li>
                                <li>Untuk sebarang pertanyaan, sila hubungi Unit IT</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <h6 class="info-title">MAKLUMAT SISTEM:</h6>
                            <div class="system-info">
                                <div class="system-item">
                                    <span class="label">Versi Sistem:</span>
                                    <span class="value">v2.1.0</span>
                                </div>
                                <div class="system-item">
                                    <span class="label">Kemaskini Terakhir:</span>
                                    <span class="value">{{ date('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Government Official Style */
body {
    font-family: 'Times New Roman', serif;
    background-color: #f5f5f5;
}

.official-header {
    background: linear-gradient(135deg, #CD853F 0%, #DAA520 100%);
    color: white;
    padding: 25px;
    border-radius: 0;
    margin: -15px -15px 20px -15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.page-title {
    font-size: 32px;
    font-weight: bold;
    letter-spacing: 1.5px;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.subtitle {
    font-size: 15px;
    opacity: 0.9;
    margin-bottom: 10px;
}

.subtitle .label {
    font-weight: normal;
}

.subtitle .value {
    font-weight: bold;
    margin-left: 10px;
}

.custom-breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.custom-breadcrumb .breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.custom-breadcrumb .breadcrumb-item.active {
    color: white;
}

.header-stats {
    text-align: right;
}

.stat-item {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
}

.stat-label {
    opacity: 0.8;
}

.stat-value {
    font-weight: bold;
    margin-left: 10px;
}

/* Statistics Cards */
.stats-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: transform 0.2s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
}

.stats-icon {
    font-size: 2.5rem;
    margin-right: 20px;
    width: 60px;
    text-align: center;
}

.stats-total .stats-icon { color: #CD853F; }
.stats-pending .stats-icon { color: #ffc107; }
.stats-ongoing .stats-icon { color: #28a745; }
.stats-ended .stats-icon { color: #dc3545; }

.stats-content {
    flex: 1;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #495057;
    line-height: 1;
}

.stats-label {
    font-size: 13px;
    font-weight: bold;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 5px;
}

/* Official Section */
.official-section {
    background: white;
    border: 1px solid #dee2e6;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.section-header {
    background: #f8f9fa;
    border-bottom: 3px solid #CD853F;
    padding: 20px 25px;
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    color: #CD853F;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.table-info {
    font-size: 14px;
}

.info-label {
    color: #6c757d;
}

.info-value {
    font-weight: bold;
    color: #CD853F;
    margin-left: 10px;
}

.section-content {
    padding: 0;
}

/* Government Table */
.table-container {
    overflow-x: auto;
}

.table-government {
    margin: 0;
}

.table-government thead th {
    background: #CD853F;
    color: white;
    border: 1px solid #B8860B;
    padding: 15px 12px;
    font-weight: bold;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    vertical-align: middle;
}

.table-government tbody td {
    padding: 15px 12px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
    background: white;
}

.table-government tbody tr:nth-child(even) td {
    background: #f8f9fa;
}

.table-government tbody tr:hover td {
    background: #e3f2fd;
}

.product-info {
    text-align: left;
}

.product-name {
    font-weight: bold;
    color: #495057;
    font-size: 14px;
    margin-bottom: 4px;
}

.product-code {
    font-size: 12px;
    color: #6c757d;
    font-style: italic;
}

.date-info {
    text-align: center;
}

.date-main {
    font-weight: bold;
    color: #495057;
    font-size: 13px;
}

.date-time {
    font-size: 12px;
    color: #6c757d;
    margin-top: 2px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge i {
    margin-right: 6px;
    font-size: 12px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-ongoing {
    background: #d1e7dd;
    color: #0f5132;
    border: 1px solid #badbcc;
}

.status-ended {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f1aeb5;
}

.btn-government {
    background: #CD853F;
    color: white;
    border: 1px solid #CD853F;
    border-radius: 4px;
    padding: 8px 16px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
}

.btn-government:hover {
    background: #DAA520;
    color: white;
    transform: translateY(-1px);
}

.no-data {
    padding: 50px 20px;
    background: #f8f9fa;
}

.no-data-content {
    color: #6c757d;
}

.no-data-content i {
    opacity: 0.5;
}

/* Footer Information */
.footer-info {
    margin-top: 30px;
}

.info-box {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.info-title {
    font-weight: bold;
    color: #CD853F;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    border-bottom: 2px solid #CD853F;
    padding-bottom: 5px;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    padding: 5px 0;
    font-size: 13px;
    color: #495057;
    border-bottom: 1px dotted #dee2e6;
}

.info-list li:last-child {
    border-bottom: none;
}

.info-list li:before {
    content: "→";
    color: #CD853F;
    margin-right: 8px;
    font-weight: bold;
}

.system-info {
    font-size: 13px;
}

.system-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dotted #dee2e6;
}

.system-item:last-child {
    border-bottom: none;
}

.system-item .label {
    color: #6c757d;
}

.system-item .value {
    font-weight: bold;
    color: #495057;
}

@media print {
    .official-header {
        background: #CD853F !important;
        -webkit-print-color-adjust: exact;
    }
    
    .stats-card {
        break-inside: avoid;
    }
}

@media (max-width: 768px) {
    .page-title {
        font-size: 24px;
    }
    
    .stats-card {
        margin-bottom: 15px;
    }
    
    .stats-icon {
        font-size: 2rem;
        margin-right: 15px;
        width: 50px;
    }
    
    .stats-number {
        font-size: 2rem;
    }
}
</style>
@endsection