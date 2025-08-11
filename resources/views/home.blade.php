@extends('layouts.app')

@push('styles')
<style>
    html, body {
        overflow-x: hidden !important;
    }

    /* Hide scrollbars in iframe for all browsers */
    iframe {
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* Internet Explorer 10+ */
        overflow: hidden !important;
    }

    iframe::-webkit-scrollbar {
        display: none; /* Safari and Chrome */
    }

    /* Additional iframe styling to prevent scroll */
    .gold-price-iframe {
        border: none;
        overflow: hidden !important;
    }
</style>
@endpush

@section('content')
<div class="space-y-8">

    <!-- Tajuk cantik -->
    <div class="relative text-center py-10">
        <h1 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-yellow-600 to-yellow-500 drop-shadow-lg tracking-wide leading-tight">
            🏆 Welcome to E-Bidding System
        </h1>
        <p class="text-gray-600 mt-3 text-base md:text-lg italic">
            Your trusted gold auction platform.
        </p>
    </div>

    <!-- Gambar -->
    <div class="flex justify-center">
        <img src="{{ asset('images/main.jpg') }}"
             alt="No One is Left Behind Banner"
             class="w-full max-w-xl rounded-lg shadow-md">
    </div>

</div>
@endsection
