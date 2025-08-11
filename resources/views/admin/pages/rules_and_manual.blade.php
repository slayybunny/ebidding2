@extends('layouts.admin.app')

@section('page-title', 'RULES & USER MANUAL')

@section('content')
<div class="container py-4">
    <div class="border bg-white rounded p-4 shadow-sm">
        <h4 class="mb-3 fw-bold text-dark">Peraturan Sistem eBidding</h4>
        <ol class="mb-4 ps-3">
            <li class="mb-2">Hanya pengguna yang berdaftar dibenarkan menyertai proses bidaan.</li>
            <li class="mb-2">Setiap bidaan adalah muktamad. Tiada penarikan balik selepas dihantar.</li>
            <li class="mb-2">Pengguna perlu memastikan baki akaun mencukupi sebelum membida.</li>
            <li class="mb-2">Bidaan yang mengelirukan atau palsu akan dibatalkan serta-merta.</li>
            <li class="mb-2">Pihak pentadbir berhak membatalkan sebarang bidaan atas sebab munasabah.</li>
        </ol>

        <hr>

        <h4 class="mt-4 mb-3 fw-bold text-dark">Manual Pengguna</h4>
        <ol class="ps-3">
            <li class="mb-2"><strong>Log Masuk:</strong> Masukkan emel dan kata laluan pada halaman log masuk sistem.</li>
            <li class="mb-2"><strong>Akses Bidaan:</strong> Klik menu “Bidding Platform” untuk melihat bidaan aktif.</li>
            <li class="mb-2"><strong>Hantar Bidaan:</strong> Pilih bidaan dan masukkan amaun bidaan anda.</li>
            <li class="mb-2"><strong>Semakan Bidaan:</strong> Lihat sejarah bidaan melalui menu “Bidding History”.</li>
            <li class="mb-2"><strong>Kemaskini Profil:</strong> Ubah maklumat peribadi serta gambar profil di halaman “Profile”.</li>
        </ol>
    </div>
</div>
@endsection
