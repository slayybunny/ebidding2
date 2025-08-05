@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">My Gold Items</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('create-listing') }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow">
            + Create Listing
        </a>
    </div>

    <table class="min-w-full bg-white border rounded shadow text-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border-b">Item</th>
                <th class="py-2 px-4 border-b">Type</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Starting Price</th>
                <th class="py-2 px-4 border-b">Date</th>
                <th class="py-2 px-4 border-b">Duration</th>
                <th class="py-2 px-4 border-b">Currency</th>
                <th class="py-2 px-4 border-b">Info</th>
                <th class="py-2 px-4 border-b">Image</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Created At</th>
                <th class="py-2 px-4 border-b">Actions</th> {{-- Tambahan --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($goldListings as $listing)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $listing->item }}</td>
                    <td class="py-2 px-4 border-b">{{ $listing->type }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($listing->price, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($listing->starting_price, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $listing->date }}</td>
                    <td class="py-2 px-4 border-b">
                        @php
                            $d = floor($listing->duration / 1440);
                            $h = floor(($listing->duration % 1440) / 60);
                            $m = $listing->duration % 60;
                        @endphp
                        {{ $d }}d {{ $h }}h {{ $m }}m
                    </td>
                    <td class="py-2 px-4 border-b">{{ $listing->currency }}</td>
                    <td class="py-2 px-4 border-b">{{ $listing->info }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($listing->image)
                            <img src="{{ asset('storage/' . $listing->image) }}" alt="Image" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400 italic">No image</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <span class="{{ $listing->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($listing->status) }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex space-x-2">
                            <a href="{{ route('edit-listing', $listing->slug) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                Edit
                            </a>

                            <form action="{{ route('delete-listing', $listing->slug) }}" method="POST" onsubmit="return confirm('Are you sure to delete this listing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="py-4 px-4 text-center text-gray-500">No listings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
