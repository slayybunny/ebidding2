@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6 text-yellow-600">Bidding Details</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Left Column: Details -->
            <div class="space-y-3">
                <p><strong>Item:</strong> {{ $listing->item }}</p>
                <p><strong>Type:</strong> {{ $listing->type }}</p>
                <p><strong>Price:</strong> RM {{ number_format($listing->price, 2) }}</p>
                <p><strong>Starting Price:</strong> RM {{ number_format($listing->starting_price, 2) }}</p>
                <p><strong>Date:</strong> {{ $listing->date }}</p>

                @php
                    $start = $listing->created_at;
                    $end = $start->copy()->addMinutes($listing->duration);
                    $now = now();
                    $isActive = $now->lt($end);

                    $d = floor($listing->duration / 1440);
                    $h = floor(($listing->duration % 1440) / 60);
                    $m = $listing->duration % 60;
                @endphp

                <p><strong>Duration:</strong> {{ $d }}d {{ $h }}h {{ $m }}m</p>
                <p><strong>Currency:</strong> {{ $listing->currency }}</p>
                <p><strong>Info:</strong> {{ $listing->info }}</p>
                <p><strong>Status:</strong>
                    <span class="{{ $isActive ? 'text-green-600' : 'text-red-600' }}">
                        {{ $isActive ? 'Active' : 'Unactive' }}
                    </span>
                </p>

                <p><strong>Start Date:</strong> {{ $start->format('Y-m-d H:i:s') }}</p>
                <p><strong>Ends At:</strong> {{ $end->format('Y-m-d H:i:s') }}</p>

                <input type="hidden" id="endTime" value="{{ $end->toIso8601String() }}">
                <p><strong>Live Duration Remaining:</strong>
                    <span id="countdown" class="font-semibold text-yellow-600">Loading...</span>
                </p>
            </div>

            <!-- Right Column: Image & Form -->
            <div class="space-y-6">
                <!-- Image -->
                @if ($listing->image)
                    <img src="{{ asset($listing->image) }}" alt="Listing Image" class="w-full rounded-lg shadow">
                @else
                    <div class="text-gray-500 italic">No image available</div>
                @endif

                <!-- Place Bid Form -->
                @php
                    $userAlreadyBid = $listing->bids()->where('member_id', auth()->id())->exists();
                @endphp

                @if ($isActive)
                    @if ($userAlreadyBid)
                        <div class="text-green-700 font-semibold">
                            You have already placed a bid for this item.
                        </div>
                    @else
                        <form id="bidForm"
                              action="{{ route('bidding.place', $listing->slug) }}"
                              method="POST"
                              class="space-y-3"
                              onsubmit="return confirmBid(event)">
                            @csrf
                            <label for="bid_amount" class="block font-semibold">
                                Your Bid ({{ $listing->currency }}):
                            </label>
                            <input type="number" name="bid_amount" step="0.01"
                                   min="{{ $listing->starting_price }}" required
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-yellow-500">
                            <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Place Bid
                            </button>
                        </form>
                    @endif
                @else
                    <div class="text-red-600 font-semibold">Bidding for this item has ended.</div>
                @endif
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

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });

    function confirmBid(e) {
        e.preventDefault(); // Stop form submission first

        if (confirm("Are you sure you want to place this bid?")) {
            e.target.submit(); // If Yes, submit form
        } else {
            return false; // If No, do nothing
        }
    }
</script>
@endpush
