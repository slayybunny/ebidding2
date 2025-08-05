@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
    $endTime = Carbon::parse($listing->date)->addMinutes($listing->duration);
@endphp

<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6">GOLD BIDDING</h2>

    {{-- Listing Info --}}
    <div class="border border-yellow-400 rounded-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center">
            <img src="{{ asset('storage/' . $listing->image) }}" class="w-32 h-32 object-cover mb-4 md:mb-0 md:mr-6" />
            <div class="flex-1 space-y-2 w-full">
                <p><strong>Item:</strong> {{ $listing->item }}</p>
                <p><strong>Type:</strong> {{ $listing->type }}</p>
                <p><strong>Price:</strong> {{ $listing->currency }} {{ number_format($listing->price, 2) }}</p>
            </div>
        </div>
    </div>

    {{-- Bidding Section --}}
    <div class="border border-yellow-400 rounded-lg p-6 mb-6 space-y-3">
        <p><strong>Starting Price:</strong> {{ $listing->currency }} {{ number_format($listing->starting_price, 2) }}</p>
        <p><strong>Start Date:</strong> {{ Carbon::parse($listing->date)->format('Y-m-d H:i:s') }}</p>
        <p><strong>Ends At:</strong> {{ $endTime->format('Y-m-d H:i:s') }}</p>

        <p class="flex justify-between items-center">
            <span class="flex items-center gap-2">
                <svg id="clock-icon" class="w-5 h-5 text-yellow-500 transform transition-transform duration-300"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <strong>Live Duration Remaining:</strong>
            </span>
            <span class="text-right font-semibold text-red-600">
                <span id="duration-left">Loading...</span>
                (<span id="duration-clock">00:00:00</span>)
            </span>
        </p>

        <p><strong>Status:</strong> <span id="status-text" class="font-semibold">Calculating...</span></p>

        {{-- Form to place bid --}}
        <div id="bid-form-container">
            <p><strong>Place Your Bid:</strong></p>
            <form action="{{ route('bidding.place', $listing->slug) }}" method="POST" class="mt-2 flex" id="bid-form">
                @csrf
                <input type="number" name="bid_amount" id="bid-amount" class="border px-4 py-2 w-full rounded-l" placeholder="Enter bid amount" required>
                <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700" id="confirm-bid-btn">Place Bid</button>
            </form>
        </div>

        <p id="bid-closed" class="text-red-500 font-semibold mt-4 hidden">Bidding has ended.</p>
    </div>

     {{-- Description Row --}}
<div class="border border-yellow-400 rounded-lg p-6 mb-6 space-y-3">
    <label class="block text-sm font-semibold text-yellow-500 mb-2">Description & Information *</label>
    <div class="border p-4 rounded-md">
        <p class="whitespace-pre-line">{!! $listing->info ?: 'No description available' !!}</p>
    </div>
</div>


    {{-- Modal for confirmation --}}
    <div id="confirmation-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h4 class="text-xl font-bold">Confirm Your Bid</h4>
            <p class="mt-2">Are you sure you want to place a bid of <span id="modal-bid-amount"></span>?</p>
            <div class="mt-4 flex justify-between">
                <button id="confirm-modal-btn" class="bg-green-600 text-white px-4 py-2 rounded">Confirm</button>
                <button id="close-modal-btn" class="bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </div>
    </div>

</div>

{{-- Countdown Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const endTime = new Date("{{ $endTime->format('Y-m-d H:i:s') }}").getTime();
        const durationDisplay = document.getElementById('duration-left');
        const clockDisplay = document.getElementById('duration-clock');
        const statusText = document.getElementById('status-text');
        const bidForm = document.getElementById('bid-form-container');
        const bidClosed = document.getElementById('bid-closed');
        const clockIcon = document.getElementById('clock-icon');
        const startingPrice = parseFloat("{{ $listing->starting_price }}"); // Starting price
        let rotateDeg = 0;

        function updateCountdown() {
            const now = new Date().getTime();
            let diff = Math.floor((endTime - now) / 1000);

            if (diff <= 0) {
                durationDisplay.textContent = "0s";
                clockDisplay.textContent = "00:00:00";
                statusText.textContent = "Ended";
                statusText.classList.remove('text-green-600');
                statusText.classList.add('text-red-600');
                bidForm.classList.add('hidden');
                bidClosed.classList.remove('hidden');
                clockIcon.style.transform = "rotate(0deg)";
                return;
            }

            let days = Math.floor(diff / 86400);
            let hours = Math.floor((diff % 86400) / 3600);
            let minutes = Math.floor((diff % 3600) / 60);
            let seconds = diff % 60;

            durationDisplay.textContent =
                (days > 0 ? days + "d " : "") +
                (hours > 0 ? hours + "h " : "") +
                (minutes > 0 ? minutes + "m " : "") +
                seconds + "s";

            let totalHours = Math.floor(diff / 3600);
            let mm = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
            let ss = String(diff % 60).padStart(2, '0');
            clockDisplay.textContent = totalHours + ":" + mm + ":" + ss;

            statusText.textContent = "Active";
            statusText.classList.add('text-green-600');
            statusText.classList.remove('text-red-600');

            rotateDeg += 6;
            clockIcon.style.transform = `rotate(${rotateDeg}deg)`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Open confirmation modal
        document.getElementById('confirm-bid-btn').addEventListener('click', function() {
            const bidAmount = parseFloat(document.getElementById('bid-amount').value);

            // Check if bid is lower than starting price
            if (bidAmount < startingPrice) {
                alert("Bid amount must be at least the starting price of RM " + startingPrice.toFixed(2));
                return; // Prevent modal from showing
            }

            document.getElementById('modal-bid-amount').textContent = "RM " + bidAmount.toFixed(2);
            document.getElementById('confirmation-modal').classList.remove('hidden');
        });

        // Close modal
        document.getElementById('close-modal-btn').addEventListener('click', function() {
            document.getElementById('confirmation-modal').classList.add('hidden');
        });

        // Confirm bid and submit form
        document.getElementById('confirm-modal-btn').addEventListener('click', function() {
            document.getElementById('bid-form').submit();
        });
    });
</script>

@endsection
