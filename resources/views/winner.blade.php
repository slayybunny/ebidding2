@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">List of Auction Winners</h2>

    @if($winners->isEmpty())
        <div class="text-gray-600">No winners have been announced yet.</div>
    @else
        <div class="space-y-6">
            @foreach($winners as $winner)
                <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $winner->listing->item }}</h3>
                        <p class="text-sm text-gray-500 mt-1">Winner: {{ $winner->member->name }}</p>
                        <p class="text-sm text-gray-500">Date: {{ \Carbon\Carbon::parse($winner->created_at)->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                            🏆 Winner
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
