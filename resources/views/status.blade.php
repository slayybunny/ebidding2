@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Bidding Status</h2>

    {{-- Mesej berjaya --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            ✅ {{ session('success') }}
            <a href="{{ route('payment.status') }}" class="ml-4 text-blue-600 underline">⬅ Back to Status</a>
        </div>
    @endif

    {{-- Mesej gagal --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            ❌ {{ session('error') }}
            <a href="{{ route('payment.status') }}" class="ml-4 text-blue-600 underline">⬅ Back to Status</a>
        </div>
    @endif

    @if($listings->isEmpty())
        <div class="text-gray-600">You have no bidding history.</div>
    @else
        @foreach($listings as $listing)
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $listing->item }}</h3>
                        <p class="text-sm text-gray-500">{{ $listing->type }}</p>
                        <p class="text-sm text-gray-500">
                            @php
                                $startDate = \Carbon\Carbon::parse($listing->date);
                                $durationMinutes = $listing->duration ?? 0; // fallback ke 0 jika kosong
                                $endDate = $startDate->copy()->addMinutes($durationMinutes);
                            @endphp
                            Ended: {{ $endDate->format('d M Y h:i A') }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        @php
                            $userBid = $listing->bids
                                ->where('member_id', auth()->id())
                                ->sortByDesc('bid_price')
                                ->first();
                        @endphp

                        @if($userBid)
                            @if($userBid->status === 'winner')
                                <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    🏆 Winner
                                </span>

                                {{-- Jika belum bayar --}}
                                @if(isset($listing->is_paid) && !$listing->is_paid)
                                    <div class="mt-2">
                                        <a href="{{ route('payment.create', $listing->id) }}"
                                           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                                            💰 Pay Now (RM {{ number_format($userBid->bid_price, 2) }})
                                        </a>
                                    </div>
                                {{-- Jika sudah bayar --}}
                                @elseif(isset($listing->is_paid) && $listing->is_paid)
                                    <div class="mt-2 text-green-700 font-semibold">
                                        ✅ Successfully Paid
                                    </div>
                                {{-- Jika pembayaran gagal --}}
                                @elseif(isset($listing->is_paid) && $listing->is_paid === false && isset($listing->payment_attempted))
                                    <div class="mt-2 text-red-700 font-semibold">
                                        ❌ Unsuccessful Payment
                                    </div>
                                @endif

                            @elseif($userBid->status === 'lose')
                                <span class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    ❌ Lose
                                </span>
                            @else
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    ⏳ Pending
                                </span>
                            @endif
                        @else
                            <span class="inline-block bg-gray-100 text-gray-800 text-sm font-semibold px-3 py-1 rounded-full">
                                No bid placed
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
