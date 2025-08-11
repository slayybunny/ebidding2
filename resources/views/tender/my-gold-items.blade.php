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

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow text-xs">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-1 px-3 border-b">Item</th>
                    <th class="py-1 px-3 border-b">Type</th>
                    <th class="py-1 px-3 border-b">Price</th>
                    <th class="py-1 px-3 border-b">Starting Price</th>
                    <th class="py-1 px-3 border-b">Date</th>
                    <th class="py-1 px-3 border-b">Duration</th>
                    <th class="py-1 px-3 border-b">Currency</th>
                    <th class="py-1 px-3 border-b">Info</th>
                    <th class="py-1 px-3 border-b">Image</th>
                    <th class="py-1 px-3 border-b">Status</th>
                    <th class="py-1 px-3 border-b">Created At</th>
                    <th class="py-1 px-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($goldListings as $listing)
                    @php
                        $start = $listing->created_at;
                        $end = $start->copy()->addMinutes($listing->duration);
                        $now = now();
                        $isActive = $now->lt($end);
                        $status = $isActive ? 'active' : 'unactive';

                        $d = floor($listing->duration / 1440);
                        $h = floor(($listing->duration % 1440) / 60);
                        $m = $listing->duration % 60;
                    @endphp
                    <tr>
                        <td class="py-1 px-3 border-b">{{ $listing->item }}</td>
                        <td class="py-1 px-3 border-b">{{ $listing->type }}</td>
                        <td class="py-1 px-3 border-b">{{ number_format($listing->price, 2) }}</td>
                        <td class="py-1 px-3 border-b">{{ number_format($listing->starting_price, 2) }}</td>
                        <td class="py-1 px-3 border-b">{{ $listing->date }}</td>
                        <td class="py-1 px-3 border-b">{{ $d }}d {{ $h }}h {{ $m }}m</td>
                        <td class="py-1 px-3 border-b">{{ $listing->currency }}</td>
                        <td class="py-1 px-3 border-b">{{ $listing->info }}</td>
                        <td class="py-1 px-3 border-b">
                            @if ($listing->image)
                                <img src="{{ asset($listing->image) }}" alt="Gold Image" class="w-32 h-auto">
                            @else
                                <span class="text-gray-500 italic">No image</span>
                            @endif
                        </td>
                        <td class="py-1 px-3 border-b">
                            <span class="{{ $status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="py-1 px-3 border-b">{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                        <td class="py-1 px-3 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('edit-listing', $listing->slug) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('delete-listing', $listing->slug) }}" method="POST"
                                      onsubmit="return confirm('Are you sure to delete this listing?');">
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
</div>
@endsection
