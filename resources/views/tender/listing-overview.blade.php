@extends('layouts.app')

@section('page-title', 'LISTING OVERVIEW')

@section('content')
<div class="min-h-screen flex justify-center items-start bg-gray-100 py-10 px-4">
    <div class="w-full" style="max-width: 900px; margin-left: auto; margin-right: auto;">
        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Listing Overview</h1>
            <p class="text-gray-600">Manage and monitor your auction listing and bids</p>
        </div>

        @if(!isset($listing))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Listing Not Found</h3>
                <p class="text-gray-500">The listing could not be found or does not exist.</p>
            </div>
        @else
            <!-- CARD -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <!-- Listing Info -->
                <div class="flex items-center justify-between border-b pb-4 mb-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $listing->item }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ $listing->date }}</p>
                    </div>
                    <div>
                        <span class="inline-block px-3 py-1 text-sm rounded-full
                            @if($listing->status === 'active') bg-green-100 text-green-800
                            @elseif($listing->status === 'closed') bg-gray-100 text-gray-800
                            @elseif($listing->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($listing->status) }}
                        </span>
                    </div>
                </div>

                <!-- Bids -->
                @if($listing->bids->count())
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bidders List</h3>
                    <div class="space-y-3">
                        @foreach($listing->bids->sortByDesc('bid_price') as $bid)
                            @php
                                $isWinner = false;
                                if ($listing->status === 'closed' && now()->greaterThanOrEqualTo($listing->end_time)) {
                                    $isWinner = ($bid->bid_price === $listing->bids->max('bid_price'));
                                }
                            @endphp
                            <div class="flex justify-between items-center p-4 rounded-lg
                                @if($isWinner) bg-green-50 border border-green-200
                                @else bg-gray-50 border border-gray-200
                                @endif">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-700 font-bold">
                                        {{ strtoupper(substr(optional($bid->member)->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $bid->member->name ?? 'No Name' }}</p>
                                        <p class="text-xs text-gray-500">
                                            @if($listing->status === 'closed' && now()->greaterThanOrEqualTo($listing->end_time))
                                                {{ $isWinner ? 'Winner' : 'Lose' }}
                                            @else
                                                Bidding in Progress
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">RM{{ number_format($bid->bid_price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Bids -->
                    <div class="text-center py-8 text-gray-500 text-sm">
                        No bids have been placed yet.
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

