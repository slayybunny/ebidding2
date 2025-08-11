@extends('layouts.app') {{-- atau layout Eyfah sendiri --}}

@section('content')
    <div class="max-w-xl mx-auto bg-white shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Bayaran Lelongan</h2>

        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>No. Telefon:</strong> {{ auth()->user()->phone }}</p>
        <p><strong>Jumlah Bayaran:</strong> RM {{ number_format($finalBidAmount, 2) }}</p>

        <form action="{{ route('make.payment') }}" method="POST">
            @csrf

            <input type="hidden" name="amount" value="{{ $finalBidAmount }}">
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
            <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Bayar Sekarang
            </button>
        </form>
    </div>
@endsection
