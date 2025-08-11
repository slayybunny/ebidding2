@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Bidding History</h2>

    @if ($bids->isEmpty())
        <div class="text-gray-600 text-center">Tiada sejarah bidaan buat masa ini.</div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($bids as $bid)
                <div class="border border-gray-300 p-6 rounded-lg shadow hover:shadow-lg transition">
                    @if($bid->listing)
                        @php
                            $isExpired = \Carbon\Carbon::now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($bid->listing->date)->addMinutes($bid->listing->duration));
                        @endphp

                        <img src="{{ asset($bid->listing->image) }}" alt="{{ $bid->listing->item }}" class="w-24 h-24 object-cover mx-auto mb-4">

                        <h3 class="text-center text-lg font-semibold">{{ $bid->listing->item }}</h3>
                        <p class="text-center text-sm text-gray-500">{{ $bid->listing->type }}</p>

                        <p class="text-center font-bold mt-2">{{ $bid->listing->currency }} {{ number_format($bid->bid_price, 2) }}</p>

                        <div class="text-center mt-4">
                            @if ($isExpired)
                                @if ($bid->status === 'winner')
                                    <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                                        🏆 Winner
                                    </span>
                                @elseif ($bid->status === 'lose')
                                    <span class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                        ❌ Lose
                                    </span>
                                @else
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full">
                                        ⏳ Pending
                                    </span>
                                @endif
                            @else
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    Bidding in Progress
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('bidding.detail', ['slug' => $bid->listing->slug]) }}" class="block mt-4 text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">View Details</a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
