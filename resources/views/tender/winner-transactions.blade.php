{{-- resources/views/tender/winner-transactions.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    // fallback kalau variable datang namanya lain (mengelakkan "Undefined variable")
    $winnerTransactions = $winnerTransactions ?? ($transactions ?? collect());
@endphp

<div class="max-w-7xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold mb-6">Winner Transactions (Tender)</h2>

    @if ($winnerTransactions->isEmpty())
        <p class="text-gray-500">No winner transactions found.</p>
    @else
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Image</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Item</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Winner</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Type</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">Bid Price (RM)</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Info</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Payment</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">Receipt</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($winnerTransactions as $t)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                @if(!empty($t->image))
                                    <img src="{{ asset('images/' . basename($t->image)) }}" alt="Item image" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-800">{{ $t->item }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $t->name }}</td>
                            <td class="px-4 py-3 text-gray-700 capitalize">{{ $t->type }}</td>
                            <td class="px-4 py-3 text-right text-green-600 font-semibold">RM {{ number_format($t->bid_price, 2) }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $t->info ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if($t->is_paid)
                                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Paid</span>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Unpaid</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($t->is_paid && !empty($t->receipt_url))
                                    {{-- if receipt_url is a full URL --}}
                                    @php
                                        $receipt = $t->receipt_url;
                                        // if stored as relative storage path, convert to asset
                                        if (!preg_match('/^https?:\/\//', $receipt) && file_exists(public_path('storage/' . $receipt))) {
                                            $receipt = asset('storage/' . $receipt);
                                        }
                                    @endphp

                                    <a href="{{ $receipt }}" target="_blank" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                        📄 View Receipt
                                    </a>
                                @else
                                    <span class="text-gray-400">No Receipt</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
