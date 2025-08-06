@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Bidaan #{{ $id }}</h2>

    <form action="{{ route('admin.bidding.update', $id) }}"

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Tajuk</label>
            <input type="text" class="form-control" id="title" name="title" value="Emas 999 10g">
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat (g)</label>
            <input type="number" class="form-control" id="weight" name="weight" value="10">
        </div>

        <div class="mb-3">
            <label for="starting_price" class="form-label">Harga Mula (RM)</label>
            <input type="number" class="form-control" id="starting_price" name="starting_price" value="300">
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Tarikh Mula</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="2025-07-17T10:00">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Tarikh Tamat</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="2025-07-18T10:00">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.bidding.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
