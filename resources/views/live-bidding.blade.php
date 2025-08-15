@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Live Bidding Listings</h2>
    <p class="text-gray-600 mb-6">Place your bids before the auction ends!</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($listings as $listing)
            @php
                $endTime = !empty($listing->end_time)
                    ? \Carbon\Carbon::parse($listing->end_time)
                    : \Carbon\Carbon::parse($listing->date)->addMinutes($listing->duration);
            @endphp

            <div class="border border-yellow-400 p-6 rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ asset($listing->image) }}" alt="{{ $listing->item }}" class="w-32 h-32 object-cover mx-auto mb-4">
                <h3 class="text-center text-lg font-semibold">{{ $listing->item }}</h3>
                <p class="text-center text-sm text-gray-500">{{ $listing->type }}</p>
                <p class="text-center font-bold mt-2">{{ $listing->currency }} {{ number_format($listing->starting_price, 2) }}</p>

                <div class="text-center mt-2">
                    <span class="font-semibold text-gray-800" data-end-time="{{ $endTime->toIso8601String() }}"></span>
                </div>

                <a href="{{ route('bidding.detail', $listing->slug) }}" class="block mt-4 text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">View</a>
            </div>
        @empty
            <p class="text-center col-span-3 text-gray-500">No items available for bidding at the moment.</p>
        @endforelse
    </div>
</div>

<script>
    function updateCountdown() {
        const timers = document.querySelectorAll('[data-end-time]');
        timers.forEach(timer => {
            const endTime = new Date(timer.dataset.endTime);
            const now = new Date();
            const timeLeft = endTime - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                timer.textContent = `Time Left: ${days}d ${hours}h ${minutes}m ${seconds}s`;
            } else {
                timer.textContent = 'Auction Ended';
                // Reload page to update listings status
                window.location.reload();
            }
        });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endsection
