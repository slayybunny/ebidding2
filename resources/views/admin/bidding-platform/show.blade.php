@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Official Header -->
    <div class="official-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="header-content">
                    <h1 class="page-title mb-1">MAKLUMAT BIDAAN</h1>
                    <div class="reference-number">
                        <span class="label">No. Rujukan:</span>
                        <span class="value">BID/2025/{{ str_pad($id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb custom-breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Utama</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.bidding.index') }}">Senarai Bidaan</a></li>
                            <li class="breadcrumb-item active">Maklumat Terperinci</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.bidding.index') }}" class="btn btn-outline-light btn-official">
                    ← KEMBALI KE SENARAI
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Product Information Table -->
            <div class="official-section mb-4">
                <div class="section-header">
                    <h3 class="section-title">A. MAKLUMAT PRODUK</h3>
                </div>
                <div class="section-content">
                    <div class="info-table-container">
                        <table class="table table-bordered info-table">
                            <tbody>
                                <tr>
                                    <td class="label-col">Nama Produk</td>
                                    <td class="value-col">Emas 999 - 10 Gram</td>
                                </tr>
                                <tr>
                                    <td class="label-col">Berat Bersih</td>
                                    <td class="value-col">10.00 gram</td>
                                </tr>
                                <tr>
                                    <td class="label-col">Tahap Kemurnian</td>
                                    <td class="value-col">999 (99.9%)</td>
                                </tr>
                                <tr>
                                    <td class="label-col">Kategori</td>
                                    <td class="value-col">Logam Berharga</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bidding Information -->
            <div class="official-section mb-4">
                <div class="section-header">
                    <h3 class="section-title">B. MAKLUMAT BIDAAN</h3>
                </div>
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-table-container">
                                <table class="table table-bordered info-table">
                                    <tbody>
                                        <tr>
                                            <td class="label-col">Harga Permulaan</td>
                                            <td class="value-col">RM 300.00</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Tarikh Mula</td>
                                            <td class="value-col">17 Julai 2025, 10:00 AM</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Tarikh Tamat</td>
                                            <td class="value-col">18 Julai 2025, 10:00 AM</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Status</td>
                                            <td class="value-col">
                                                <span class="status-badge status-completed">SELESAI</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-table-container">
                                <table class="table table-bordered info-table">
                                    <tbody>
                                        <tr>
                                            <td class="label-col">Bidaan Tertinggi</td>
                                            <td class="value-col font-weight-bold text-golden">RM 450.00</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Jumlah Bidaan</td>
                                            <td class="value-col">15 bidaan</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Bilangan Pembida</td>
                                            <td class="value-col">8 orang</td>
                                        </tr>
                                        <tr>
                                            <td class="label-col">Peratusan Kenaikan</td>
                                            <td class="value-col">
                                                <span class="text-success">+50.00%</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Winner Information -->
            <div class="official-section mb-4">
                <div class="section-header">
                    <h3 class="section-title">C. MAKLUMAT PEMENANG</h3>
                </div>
                <div class="section-content">
                    <div class="winner-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="info-table-container">
                                    <table class="table table-bordered info-table">
                                        <tbody>
                                            <tr>
                                                <td class="label-col">Nama Pemenang</td>
                                                <td class="value-col">AHMAD BIN RAHMAN</td>
                                            </tr>
                                            <tr>
                                                <td class="label-col">No. ID Pengguna</td>
                                                <td class="value-col">USER123456</td>
                                            </tr>
                                            <tr>
                                                <td class="label-col">Bidaan Akhir</td>
                                                <td class="value-col font-weight-bold">RM 450.00</td>
                                            </tr>
                                            <tr>
                                                <td class="label-col">Masa Bidaan</td>
                                                <td class="value-col">18 Julai 2025, 09:58 AM</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="winner-seal">
                                    <div class="seal-circle">
                                        <div class="seal-text">
                                            <div class="seal-title">PEMENANG</div>
                                            <div class="seal-subtitle">BIDAAN</div>
                                        </div>
                                    </div>
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
/* Official Government Style with Golden Brown */
body {
    font-family: 'Times New Roman', serif;
    background-color: #f8f9fa;
}

.official-header {
    background: linear-gradient(135deg, #CD853F 0%, #8B7355 50%, #696969 100%);
    color: white;
    padding: 20px;
    border-radius: 0;
    margin: -15px -15px 20px -15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.page-title {
    font-size: 28px;
    font-weight: bold;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-transform: uppercase;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.reference-number {
    font-size: 14px;
    opacity: 0.9;
}

.reference-number .label {
    font-weight: normal;
}

.reference-number .value {
    font-weight: bold;
    margin-left: 10px;
    color: #F5DEB3;
}

.custom-breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.custom-breadcrumb .breadcrumb-item a {
    color: rgba(245, 222, 179, 0.8);
    text-decoration: none;
}

.custom-breadcrumb .breadcrumb-item.active {
    color: #F5DEB3;
}

.btn-official {
    border: 2px solid #F5DEB3;
    color: #F5DEB3;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-official:hover {
    background: #F5DEB3;
    color: #CD853F;
    border-color: #F5DEB3;
    transform: translateY(-1px);
}

.official-section {
    background: white;
    border: 1px solid #ddd;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(205, 133, 63, 0.1);
    border-radius: 6px;
    overflow: hidden;
}

.section-header {
    background: linear-gradient(90deg, #F5F5F5 0%, #E8E8E8 100%);
    border-bottom: 3px solid #CD853F;
    padding: 15px 20px;
}

.section-title {
    font-size: 18px;
    font-weight: bold;
    color: #CD853F;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.section-content {
    padding: 20px;
}

.info-table-container {
    background: white;
    border-radius: 4px;
    overflow: hidden;
}

.info-table {
    margin: 0;
    border: 1px solid #ddd;
}

.info-table td {
    padding: 14px 16px;
    vertical-align: middle;
    border: 1px solid #e5e5e5;
}

.label-col {
    background: linear-gradient(90deg, #F8F8F8 0%, #F0F0F0 100%);
    font-weight: bold;
    width: 40%;
    color: #696969;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
    border-right: 2px solid #CD853F;
}

.value-col {
    background: white;
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

.text-golden {
    color: #CD853F !important;
    font-weight: bold;
}

.status-badge {
    padding: 8px 14px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 11px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
}

.status-completed {
    background: linear-gradient(45deg, #CD853F, #DAA520);
    color: white;
    box-shadow: 0 2px 6px rgba(205, 133, 63, 0.3);
}

.winner-box {
    background: linear-gradient(135deg, #FFF8DC 0%, #F5F5DC 100%);
    border: 2px solid #CD853F;
    border-left: 6px solid #CD853F;
    padding: 25px;
    border-radius: 8px;
    position: relative;
}

.winner-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #CD853F 0%, #DAA520 50%, #B8860B 100%);
}

.winner-seal {
    padding: 20px;
}

.seal-circle {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: linear-gradient(135deg, #CD853F 0%, #DAA520 50%, #B8860B 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 6px 20px rgba(205, 133, 63, 0.4);
    border: 4px solid white;
    position: relative;
}

.seal-circle::before {
    content: '';
    position: absolute;
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 2px dashed rgba(255,255,255,0.5);
}

.seal-text {
    text-align: center;
    color: white;
    z-index: 2;
}

.seal-title {
    font-size: 17px;
    font-weight: bold;
    line-height: 1.1;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.seal-subtitle {
    font-size: 14px;
    font-weight: 600;
    opacity: 0.95;
    letter-spacing: 0.5px;
}

/* Additional Golden Brown Accents */
.info-table tr:hover {
    background: rgba(245, 222, 179, 0.1);
}

.winner-box .info-table .label-col {
    background: linear-gradient(90deg, #F5DEB3 0%, #DEB887 100%);
    color: #8B4513;
    border-right: 2px solid #B8860B;
}

/* Enhanced Hover Effects */
.official-section:hover {
    box-shadow: 0 4px 15px rgba(205, 133, 63, 0.15);
    transform: translateY(-1px);
    transition: all 0.3s ease;
}

.info-table td:hover {
    background: rgba(205, 133, 63, 0.05);
}

/* Print Styles */
@media print {
    .official-header {
        background: linear-gradient(135deg, #CD853F 0%, #8B7355 50%, #696969 100%) !important;
        -webkit-print-color-adjust: exact;
    }
    
    .btn-official {
        display: none;
    }
    
    .seal-circle {
        background: #CD853F !important;
        -webkit-print-color-adjust: exact;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 24px;
    }
    
    .official-header {
        margin: -10px -10px 15px -10px;
        padding: 15px;
    }
    
    .seal-circle {
        width: 100px;
        height: 100px;
    }
    
    .seal-title {
        font-size: 14px;
    }
    
    .seal-subtitle {
        font-size: 12px;
    }
}
</style>
@endsection