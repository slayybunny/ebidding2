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

    <h1 class="text-2xl font-bold text-gray-800">WELCOME TO E-BIDDING SYSTEM</h1>

    <div class="flex justify-center">
        <img src="{{ asset('images/main.jpg') }}"
             alt="No One is Left Behind Banner"
             class="w-full max-w-xl rounded-lg shadow-md">
    </div>

</div>
@endsection
