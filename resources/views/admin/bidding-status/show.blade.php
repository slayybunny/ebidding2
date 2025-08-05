@extends('layouts.admin.app')

@section('title', 'Maklumat Lelongan')
@section('header', 'Maklumat Lelongan')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body px-5 py-4">
            <h4 class="fw-bold mb-4 text-dark">
                <i class="fas fa-info-circle text-primary me-2"></i>Butiran Lelongan
            </h4>

            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Nama Produk</label>
                    <div class="form-control-plaintext">Gold Bar 100g</div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Kod Produk</label>
                    <div class="form-control-plaintext">GB100-001</div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Tarikh Mula</label>
                    <div class="form-control-plaintext">2025-08-01 10:00 AM</div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Tarikh Tamat</label>
                    <div class="form-control-plaintext">2025-08-01 12:00 PM</div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Status</label>
                    <div class="form-control-plaintext">
                        <span class="badge bg-secondary px-3 py-2 rounded-pill">Akan Bermula</span>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="fw-semibold">Tawaran Tertinggi</label>
                    <div class="form-control-plaintext">RM 5,000.00</div>
                </div>
            </div>

            <a href="{{ route('admin.bidding-status.index') }}" class="btn btn-outline-secondary rounded-pill mt-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
