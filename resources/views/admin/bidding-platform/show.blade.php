@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lihat Bidaan #{{ $id }}</h2>

    <div class="card p-4">
        <p><strong>Nama Produk:</strong> Emas 999 10g</p>
        <p><strong>Berat:</strong> 10 gram</p>
        <p><strong>Harga Mula:</strong> RM 300</p>
        <p><strong>Tarikh Mula:</strong> 17/07/2025 10:00</p>
        <p><strong>Tarikh Tamat:</strong> 18/07/2025 10:00</p>
        <p><strong>Status:</strong> Tamat</p>
        <a href="{{ route('admin.bidding.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
</div>
@endsection
