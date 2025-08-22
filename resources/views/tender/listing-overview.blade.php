@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Listing Overview</h1>
        <p class="text-gray-600">Manage and monitor your auction listings and bids</p>
    </div>

    @if($listings->isNotEmpty())
        @foreach($listings as $listing)
            @php
                // Gabungkan tarikh + masa untuk start & end
                $startTime = \Carbon\Carbon::parse($listing->start_date . ' ' . $listing->start_time);
                $endTime   = \Carbon\Carbon::parse($listing->end_date . ' ' . $listing->end_time);
                $now = now();

                // Status listing
                $isExpired = $now->gte($endTime);
                $liveStatus = $isExpired ? 'Ended' : 'Active';

                // Tentukan winner & loser jika lelong tamat
                $bids = $listing->bids()->orderByDesc('bid_price')->get();
                if ($isExpired && $bids->count() > 0) {
                    $highestBidId = $bids->first()->id;
                    foreach($bids as $bid) {
                        if($bid->id == $highestBidId){
                            $bid->status = 'winner';
                        } else {
                            $bid->status = 'lose';
                        }
                    }
                }
            @endphp

            <div class="space-y-6">
                <!-- Listing Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{ $listing->item }}</h2>
                                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                                    <span>Status:
                                        <span class="font-medium text-{{ $liveStatus == 'Active' ? 'green' : 'red' }}-600">
                                            {{ $liveStatus }}
                                        </span>
                                    </span>
                                    @if (!$isExpired)
                                        <div class="flex items-center">
                                            <span class="mr-1">Time Left:</span>
                                            <span class="font-semibold text-gray-800"
                                                  data-end-time="{{ $endTime->toIso8601String() }}"></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-2xl font-bold text-gray-900">
                                    {{ $listing->currency }} {{ number_format($listing->starting_price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8">
                            <div class="flex-shrink-0 w-full md:w-1/3">
                                @if($listing->image)
                                    <img src="{{ asset($listing->image) }}" alt="{{ $listing->item }}"
                                         class="w-24 h-24 object-cover rounded-md shadow-sm">
                                @else
                                    <div class="w-24 h-24 bg-gray-100 flex items-center justify-center rounded-md">
                                        <span class="text-gray-400 text-sm">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                                <p class="text-gray-600 mt-2">{{ $listing->info }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bids Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Bids</h3>
                    @if($bids->isEmpty())
                        <p class="text-gray-500">No bids have been placed yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bid Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($bids as $bid)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bid->member_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bid->member->name ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $listing->currency }} {{ number_format($bid->bid_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($bid->status === 'winner') bg-green-100 text-green-800
                                                    @elseif($bid->status === 'lose') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($bid->status ?? ($isExpired ? 'Lose' : 'Pending')) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $bid->created_at->format('d M Y, H:i:s') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>No listing found.</p>
    @endif
</div>

<script>
function updateCountdown() {
    const timers = document.querySelectorAll('[data-end-time]');
    timers.forEach(timer => {
        const endTime = new Date(timer.dataset.endTime);
        const now = new Date();
        const timeLeft = endTime - now;

        if (timeLeft > 0) {
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            timer.textContent = `${hours}h ${minutes}m`;
        } else {
            timer.textContent = 'Ended';
        }
    });
}
setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection
