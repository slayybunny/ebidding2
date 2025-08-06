@extends('layouts.app')

@section('page-title', 'MY GOLD ITEMS')

@section('content')
<div class="min-h-screen bg-gray-100 px-6 py-10">
    <div class="ml-[260px] mr-auto max-w-[calc(100vw-300px)] bg-white shadow-lg rounded-lg p-6 overflow-x-auto">
    <table class="w-full table-auto text-sm text-center border border-gray-300">
            <thead class="bg-gray-200 text-xs uppercase">
                <tr>
                    <th class="border px-2 py-2">Item</th>
                    <th class="border px-2 py-2">Type</th>
                    <th class="border px-2 py-2">Price</th>
                    <th class="border px-2 py-2">Start Price</th>
                    <th class="border px-2 py-2">Date</th>
                    <th class="border px-2 py-2">Duration</th>
                    <th class="border px-2 py-2">Currency</th>
                    <th class="border px-2 py-2">Info</th>
                    <th class="border px-2 py-2">Image</th>
                    <th class="border px-2 py-2">Status</th>
                    <th class="border px-2 py-2">Created</th>
                    <th class="border px-2 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($goldListings as $listing)
                    <tr>
                        <td class="border px-2 py-2 truncate">{{ $listing->item }}</td>
                        <td class="border px-2 py-2 truncate">{{ $listing->type }}</td>
                        <td class="border px-2 py-2 truncate">{{ number_format($listing->price, 2) }}</td>
                        <td class="border px-2 py-2 truncate">{{ number_format($listing->starting_price, 2) }}</td>
                        <td class="border px-2 py-2 truncate">{{ $listing->date }}</td>
                        <td class="border px-2 py-2 truncate">
                            @php
                                $d = floor($listing->duration / 1440);
                                $h = floor(($listing->duration % 1440) / 60);
                                $m = $listing->duration % 60;
                            @endphp
                            {{ $d }}d {{ $h }}h {{ $m }}m
                        </td>
                        <td class="border px-2 py-2 truncate">{{ $listing->currency }}</td>
                        <td class="border px-2 py-2 truncate">{{ $listing->info }}</td>
                        <td class="border px-2 py-2">
                            @if($listing->image)
                                <img src="{{ asset('storage/' . $listing->image) }}" class="w-10 h-10 object-cover rounded mx-auto" alt="Image">
                            @else
                                <span class="text-gray-500 italic text-xs">No image</span>
                            @endif
                        </td>
                        <td class="border px-2 py-2">
                            <span class="font-semibold text-xs {{ $listing->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($listing->status) }}
                            </span>
                        </td>
                        <td class="border px-2 py-2 text-xs">{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                        <td class="border px-2 py-2">
                            <div class="flex justify-center gap-1">
                                <a href="{{ route('edit-listing', $listing->slug) }}" class="px-1 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">Edit</a>
                                <form action="{{ route('delete-listing', $listing->slug) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-1 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-gray-500 italic py-4 text-sm">No listings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
