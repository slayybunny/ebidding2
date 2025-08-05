@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Bidaan Baru</h2>

    <form action="{{ route('admin.bidding.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tajuk" class="form-label">Tajuk Bidaan</label>
            <input type="text" name="tajuk" id="tajuk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
            <input type="datetime-local" name="tarikh_mula" id="tarikh_mula" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tarikh_tamat" class="form-label">Tarikh Tamat</label>
            <input type="datetime-local" name="tarikh_tamat" id="tarikh_tamat" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Hantar</button>
        <a href="{{ route('admin.bidding.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
