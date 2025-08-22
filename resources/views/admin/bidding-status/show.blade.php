<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>

    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="container max-w-4xl w-full">
            <div class="bg-white rounded-xl shadow-2xl p-8 mb-6 border border-gray-200">
                <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-6">Auction Details</h1>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100 shadow-md">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">Product Information</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Item:</strong> {{ $listing->item ?? 'N/A' }}</li>
                            <li><strong>Owner:</strong> {{ $listing->member->name ?? 'Unknown' }}</li>
                            <li><strong>Description:</strong> {{ $listing->info ?? '-' }}</li>
                            <li><strong>Starting Price:</strong> RM {{ number_format($listing->starting_price, 2) }}
                            </li>
                            <li><strong>Current Price:</strong> RM {{ number_format($currentPrice, 2) }}</li>
                            <li><strong>Status:</strong> {{ ucfirst($listing->status ?? 'N/A') }}</li>
                            {{-- UPDATED LINE FOR START TIME --}}
                            <li><strong>Start Time:</strong>
                                {{ \Carbon\Carbon::parse($listing->created_at)->format('d/m/Y h:i A') ?? 'N/A' }}</li>
                            {{-- UPDATED LINE FOR END TIME --}}
                            <li><strong>End Time:</strong>
                                {{ $listing->end_time ? \Carbon\Carbon::parse($listing->end_time)->format('d/m/Y h:i A') : 'N/A' }}
                            </li>
                        </ul>
                    </div>
                    <div
                        class="bg-yellow-50 rounded-lg p-6 border border-yellow-200 shadow-md flex flex-col justify-center items-center text-center">
                        @if ($highestBid)
                            <span class="text-5xl mb-2">🏆</span>
                            <p class="text-2xl font-bold text-yellow-800">Highest Bid</p>
                            <p class="text-4xl font-extrabold text-yellow-900 mt-2">RM
                                {{ number_format($highestBid->bid_price, 2) }}</p>
                            <p class="text-lg text-yellow-700 mt-1">by {{ $highestBid->member->name ?? 'Unknown' }}</p>
                        @else
                            <span class="text-5xl mb-2">🤷‍♂️</span>
                            <p class="text-xl text-gray-600">No bids placed yet.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Bid History</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Bil</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Member</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Bid Price (RM)</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Time</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bids as $index => $bid)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $bid->member->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">RM
                                            {{ number_format($bid->bid_price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ ucfirst($bid->status ?? 'pending') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $bid->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8 text-gray-500 text-sm">No bids yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('admin.bidding-status.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-800 text-white font-semibold rounded-lg shadow-lg hover:bg-gray-900 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Bidding Status
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
