@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Bidding Status</h1>
        <p class="text-gray-600">Lihat status bidaan anda dan siapa yang menang.</p>
    </div>

    <!-- Check if there are any bids -->
    @if($bids->isEmpty())  <!-- Check if there are no bids -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Bids Yet</h3>
            <p class="text-gray-500">Tiada bidaan pada senarai ini.</p>
        </div>
    @else
        <!-- Display Bids -->
        <div class="space-y-6">
            @foreach($bids as $bid)
                @php
                    // Determine if bidding has closed and assign status
                    $isWinner = false;
                    if ($bid->listing->status === 'closed' && now()->greaterThanOrEqualTo($bid->listing->end_time)) {
                        // Determine if this bid is the highest
                        $isWinner = ($bid->bid_price === $bid->listing->bids->max('bid_price'));
                    }
                @endphp

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 flex items-center justify-between
                    @if($isWinner)
                        border-green-200 bg-green-50
                    @else
                        border-gray-200 bg-gray-50
                    @endif
                ">
                    <!-- Item Info -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-medium text-gray-700">
                                {{ strtoupper(substr(optional($bid->member)->name, 0, 2)) }}  <!-- First 2 letters of name -->
                            </span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $bid->listing->item }}  <!-- Item title (name) -->
                            </p>

                            <!-- Display Winner/Loser status -->
                            @if($bid->listing->status === 'closed' && now()->greaterThanOrEqualTo($bid->listing->end_time))
                                @if($isWinner)
                                    <p class="text-xs text-green-600">Winner</p>
                                @else
                                    <p class="text-xs text-red-600">Lose</p>
                                @endif
                            @else
                                <p class="text-xs text-gray-600">Bidding in Progress</p>
                            @endif
                        </div>
                    </div>

                    <!-- Bid Amount -->
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">RM{{ number_format($bid->bid_price, 2) }}</p>
                    </div>
                 <!-- Add Cancel Button outside the item box -->
                        @if($bid->listing->status === 'active')
                            <div class="text-right mt-4">
                               <form action="{{ route('bid.cancel', $bid->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your bid?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">
        Cancel Bid
    </button>
</form>

                            </div>
                        @else
                            <p class="text-xs text-gray-600">This bid cannot be cancelled as the auction is closed.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
