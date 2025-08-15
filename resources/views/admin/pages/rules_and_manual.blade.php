@extends('layouts.admin.app')

@section('page-title', 'Peraturan & Manual Pengguna')

@section('content')
<div class="container py-4">
    {{-- Breadcrumbs for navigation, essential for user orientation --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-dark">Dashboard</a></li>
            <li class="breadcrumb-item active text-secondary" aria-current="page">Peraturan & Manual Pengguna</li>
        </ol>
    </nav>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            {{-- Section: Peraturan Sistem eBidding --}}
            <h4 class="mb-3 fw-bold text-dark border-bottom pb-2">Peraturan Sistem eBidding</h4>
            <ol class="list-unstyled mb-4 text-muted">
                <li class="d-flex align-items-start mb-2">
                    <span class="badge bg-primary text-white me-2 mt-1">1</span>
                    Hanya pengguna yang berdaftar dibenarkan menyertai proses bidaan.
                </li>
                <li class="d-flex align-items-start mb-2">
                    <span class="badge bg-primary text-white me-2 mt-1">2</span>
                    Setiap bidaan adalah muktamad. Tiada penarikan balik selepas dihantar.
                </li>
                <li class="d-flex align-items-start mb-2">
                    <span class="badge bg-primary text-white me-2 mt-1">3</span>
                    Pengguna perlu memastikan baki akaun mencukupi sebelum membida.
                </li>
                <li class="d-flex align-items-start mb-2">
                    <span class="badge bg-primary text-white me-2 mt-1">4</span>
                    Bidaan yang mengelirukan atau palsu akan dibatalkan serta-merta.
                </li>
                <li class="d-flex align-items-start mb-2">
                    <span class="badge bg-primary text-white me-2 mt-1">5</span>
                    Pihak pentadbir berhak membatalkan sebarang bidaan atas sebab munasabah.
                </li>
            </ol>

            <hr class="my-5">

            {{-- Section: Manual Pengguna --}}
            <h4 class="mt-4 mb-3 fw-bold text-dark border-bottom pb-2">Manual Pengguna</h4>
            <ol class="list-unstyled text-muted">
                <li class="d-flex align-items-start mb-3">
                    <span class="badge bg-primary text-white me-2 mt-1">1</span>
                    <div>
                        <strong class="text-dark">Log Masuk:</strong> Masukkan emel dan kata laluan pada halaman log masuk sistem.
                    </div>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <span class="badge bg-primary text-white me-2 mt-1">2</span>
                    <div>
                        <strong class="text-dark">Akses Bidaan:</strong> Klik menu “Bidding Platform” untuk melihat bidaan aktif.
                    </div>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <span class="badge bg-primary text-white me-2 mt-1">3</span>
                    <div>
                        <strong class="text-dark">Hantar Bidaan:</strong> Pilih bidaan dan masukkan amaun bidaan anda.
                    </div>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <span class="badge bg-primary text-white me-2 mt-1">4</span>
                    <div>
                        <strong class="text-dark">Semakan Bidaan:</strong> Lihat sejarah bidaan melalui menu “Bidding History”.
                    </div>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <span class="badge bg-primary text-white me-2 mt-1">5</span>
                    <div>
                        <strong class="text-dark">Kemaskini Profil:</strong> Ubah maklumat peribadi serta gambar profil di halaman “Profile”.
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection