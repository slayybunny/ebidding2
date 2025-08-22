@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden">

        {{-- Header --}}
        <div class="relative bg-gray-50 text-gray-800 p-6 md:p-8 text-center border-b border-gray-200">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-1">{{ $listing->item }}</h1>
            <p class="text-lg md:text-xl font-semibold text-gray-600">{{ $listing->type }}</p>

            <div class="mt-4 flex items-center justify-center space-x-2">
                <p class="text-lg font-semibold text-gray-700">Time Remaining:</p>
                <div class="bg-gray-200 text-gray-900 font-bold px-3 py-1 rounded-lg">
                    <span id="countdown">Loading...</span>
                </div>
                <input type="hidden" id="endTime" value="{{ \Carbon\Carbon::parse($listing->end_date . ' ' . $listing->end_time)->toIso8601String() }}">
            </div>
        </div>

        <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            {{-- Left column: Image --}}
            <div class="lg:col-span-1 bg-white rounded-lg shadow-md p-4 flex items-center justify-center">
                @if ($listing->image)
                    <img src="{{ asset($listing->image) }}" alt="{{ $listing->item }}" class="w-full h-auto max-h-[500px] object-contain rounded-lg">
                @else
                    <div class="w-full h-80 md:h-96 flex items-center justify-center bg-gray-200 text-gray-500 italic rounded-lg">
                        No image available
                    </div>
                @endif
            </div>

            {{-- Right column: Item Details + Bid Form + Top 5 Bids --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Item Details (table-like list) --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-md space-y-2">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">Item Details</h2>
                    <div class="grid grid-cols-2 gap-4 text-gray-700">
                        <p><strong>Item:</strong></p><p>{{ $listing->item }}</p>
                        <p><strong>Type:</strong></p><p>{{ $listing->type }}</p>
                        <p><strong>Price:</strong></p><p>RM {{ number_format($listing->price, 2) }}</p>
                        <p><strong>Starting Price:</strong></p><p>RM {{ number_format($listing->starting_price, 2) }}</p>
                        <p><strong>Date Ends:</strong></p>
                        <p>
                            @php
                                $end = \Carbon\Carbon::parse($listing->end_date . ' ' . $listing->end_time);
                            @endphp
                            {{ $end->format('d/m/Y h:i A') }}
                        </p>
                        <p><strong>Duration:</strong></p>
                        <p>
                            @php
                                $start = \Carbon\Carbon::parse($listing->start_date . ' ' . $listing->start_time);
                            @endphp
                            {{ $start->format('d/m/Y h:i A') }} → {{ $end->format('d/m/Y h:i A') }}
                        </p>
                        <p><strong>Currency:</strong></p><p>{{ $listing->currency }}</p>
                        <p><strong>Info:</strong></p><p>{{ $listing->info }}</p>
                        <p><strong>Status:</strong></p>
                        <p>
                            @php
                                $isActive = now()->between($start, $end);
                            @endphp
                            <span class="{{ $isActive ? 'text-green-600' : 'text-red-600' }}">
                                {{ $isActive ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                        <p><strong>Created At:</strong></p><p>{{ $listing->created_at->format('d/m/Y h:i A') }}</p>
                    </div>
                </div>

                {{-- Place Your Bid --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-md space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">Place Your Bid</h2>

                    @if ($isActive)
                        @if($listing->bids()->where('member_id', auth()->id())->exists())
                            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                                <p class="font-bold">Bid Placed</p>
                                <p class="text-sm mt-1">You have already placed a bid for this item.</p>
                            </div>
                        @else
                            <form id="bidForm" action="{{ route('bidding.place', $listing->slug) }}" method="POST" class="space-y-4" onsubmit="return confirmBid(event)">
                                @csrf
                                <div class="flex flex-col">
                                    <label for="bid_amount" class="font-semibold text-gray-700">Your Bid ({{ $listing->currency }}):</label>
                                    <input type="number" name="bid_amount" step="0.01" min="{{ $listing->starting_price }}" required
                                        class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300">
                                </div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                                    Place Bid
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Bidding Ended</p>
                            <p class="text-sm mt-1">Bidding for this item has ended.</p>
                        </div>
                    @endif
                </div>

                {{-- Top 5 Highest Bids --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-md space-y-4 mt-6">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">Top 5 Highest Bids</h2>
                    @php
                        $topBids = $listing->bids()->orderByDesc('bid_price')->take(5)->with('member')->get();
                    @endphp
                    @if($topBids->count())
                        <ol class="list-decimal list-inside space-y-2 text-gray-700">
                            @foreach($topBids as $bid)
                                <li>
                                    <span class="font-semibold">{{ $bid->member->name ?? 'Unknown' }}</span> -
                                    RM {{ number_format($bid->bid_price, 2) }}
                                    @if($bid->status)
                                        <span class="text-sm text-gray-500">({{ ucfirst($bid->status) }})</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="text-gray-500">No bids placed yet.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    function updateCountdown() {
        const countdownEl = document.getElementById('countdown');
        const endTimeInput = document.getElementById('endTime');
        if (!countdownEl || !endTimeInput) return;

        const endTime = new Date(endTimeInput.value).getTime();
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {
            countdownEl.textContent = "Bidding ended";
            return;
        }

        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        countdownEl.textContent = `${hours}h ${minutes}m`;
    }

    updateCountdown();
    setInterval(updateCountdown, 60000); // update setiap minit
});

function confirmBid(e) {
    e.preventDefault();
    if (confirm("Are you sure you want to place this bid?")) {
        e.target.submit();
    } else {
        return false;
    }
}
</script>
@endpush
