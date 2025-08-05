@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Bidding History</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($listings as $listing)
            <div class="border border-gray-300 p-6 rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->item }}" class="w-24 h-24 object-cover mx-auto mb-4">

                <h3 class="text-center text-lg font-semibold">{{ $listing->item }}</h3>
                <p class="text-center text-sm text-gray-500">{{ $listing->type }}</p>
                <p class="text-center font-bold mt-2">{{ $listing->currency }} {{ number_format($listing->starting_price, 2) }}</p>

                <p class="text-center mt-2 text-sm text-gray-500">Bidding ended</p>

                @php
                    // Get the highest bid price for this listing
                    $highestBid = $listing->bids->sortByDesc('bid_price')->first();
                @endphp

                @if ($highestBid)
                    <p class="text-center mt-2 text-lg font-semibold">Highest Bid: {{ $listing->currency }} {{ number_format($highestBid->bid_price, 2) }}</p>
                    <p class="text-center text-sm text-gray-500">Bid placed by: {{ $highestBid->user->name }}</p>
                @else
                    <p class="text-center text-sm text-gray-500">No bids placed</p>
                @endif

                <a href="{{ route('bidding.detail', ['slug' => $listing->slug]) }}" class="block mt-4 text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">View Details</a>
            </div>
        @empty
            <p class="text-center col-span-3 text-gray-500">Tiada sejarah bidaan buat masa ini.</p>
        @endforelse
    </div>
</div>
@endsection
