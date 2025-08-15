@extends('layouts.admin.app')

@section('page-title', 'Peraturan & Manual Pengguna')

@section('content')
<<<<<<< HEAD
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
=======
    <div class="container py-4">
        <div class="border bg-white rounded p-4 shadow-sm">
            <h4 class="mb-3 fw-bold text-dark">eBidding System Rules</h4>
            <ol class="mb-4 ps-3">
                <li class="mb-2">Only registered users are allowed to participate in the bidding process.</li>
                <li class="mb-2">Each bid is final. No withdrawals are permitted after submission.</li>
                <li class="mb-2">Users must ensure their account has a sufficient balance before placing a bid.</li>
                <li class="mb-2">Misleading or fake bids will be immediately canceled.</li>
                <li class="mb-2">The administrator reserves the right to cancel any bid for a reasonable cause.</li>
            </ol>

            <hr>

            <h4 class="mt-4 mb-3 fw-bold text-dark">User Manual</h4>
            <ol class="ps-3">
                <li class="mb-2"><strong>Log In:</strong> Enter your email and password on the system's login page.</li>
                <li class="mb-2"><strong>Access Bids:</strong> Click the “Bidding Platform” menu to view active bids.</li>
                <li class="mb-2"><strong>Submit a Bid:</strong> Select a bid and enter your bid amount.</li>
                <li class="mb-2"><strong>Review Bids:</strong> View your bidding history through the “Bidding History”
                    menu.</li>
                <li class="mb-2"><strong>Update Profile:</strong> Change your personal information and profile picture on
                    the “Profile” page.</li>
            </ol>
        </div>
    </div>
@endsection
>>>>>>> 17d44544444403c83c5c411f29c1e46459bf3468
