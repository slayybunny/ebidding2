@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Listing Overview</h1>
        <p class="text-gray-600">Manage and monitor your auction listings and bids</p>
    </div>

    <!-- FIX: Change to check if $listing is null -->
    @if($listing == null)
        <!-- Listing not found -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Listing Not Found</h3>
            <p class="text-gray-500">The requested listing could not be found.</p>
        </div>
    @else
        <!-- Listings Details -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $listing->item }}</h2>
                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $listing->date }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($listing->status === 'active') bg-green-100 text-green-800
                                @elseif($listing->status === 'closed') bg-gray-100 text-gray-800
                                @elseif($listing->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($listing->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bids Section -->
                <div class="px-6 py-4">
                    @if($listing->bids->count())
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Bidders List</h3>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                {{ $listing->bids->count() }} {{ $listing->bids->count() === 1 ? 'bid' : 'bids' }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @foreach($listing->bids->sortByDesc('bid_price') as $bid)
                                @php
                                    $isWinner = $bid->status === 'winner';
                                    $isLose = $bid->status === 'lose';
                                @endphp

                                <div class="flex items-center justify-between p-4 rounded-lg border
                                    @if($isWinner) border-green-200 bg-green-50
                                    @elseif($isLose) border-red-200 bg-red-50
                                    @else border-gray-200 bg-gray-50
                                    @endif">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ strtoupper(substr(optional($bid->member)->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $bid->member->name ?? 'No Name' }}</p>

                                            @if($isWinner)
                                                <p class="text-xs text-green-600">Winner</p>
                                            @elseif($isLose)
                                                <p class="text-xs text-red-600">Lose</p>
                                            @else
                                                <p class="text-xs text-gray-600">Bidding in Progress</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900">RM{{ number_format($bid->bid_price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No Bids State -->
                        <div class="text-center py-8">
                            <div class="w-12 h-12 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm">No bids have been placed yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
