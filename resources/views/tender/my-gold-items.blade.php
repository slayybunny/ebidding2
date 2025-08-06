@extends('layouts.app')

@section('page-title', 'MY GOLD ITEMS')

@section('content')
<div class="py-5">
    <div class="max-w-6xl mx-auto px-4">

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-end mb-4">
            <a href="{{ route('create-listing') }}" class="btn btn-warning">
                + Create Listing
            </a>
        </div>

        <div class="table-responsive">
           <table class="table table-bordered table-hover align-middle text-center w-full table-fixed">
                <thead class="table-light">
                    <tr>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Starting Price</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Currency</th>
                        <th>Info</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($goldListings as $listing)
                        <tr>
                            <td>{{ $listing->item }}</td>
                            <td>{{ $listing->type }}</td>
                            <td>{{ number_format($listing->price, 2) }}</td>
                            <td>{{ number_format($listing->starting_price, 2) }}</td>
                            <td>{{ $listing->date }}</td>
                            <td>
                                @php
                                    $d = floor($listing->duration / 1440);
                                    $h = floor(($listing->duration % 1440) / 60);
                                    $m = $listing->duration % 60;
                                @endphp
                                {{ $d }}d {{ $h }}h {{ $m }}m
                            </td>
                            <td>{{ $listing->currency }}</td>
                            <td>{{ $listing->info }}</td>
                            <td>
                                @if($listing->image)
                                    <img src="{{ asset('storage/' . $listing->image) }}" alt="Image" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">No image</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold {{ $listing->status === 'active' ? 'text-success' : 'text-danger' }}">
                                    {{ ucfirst($listing->status) }}
                                </span>
                            </td>
                            <td>{{ $listing->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('edit-listing', $listing->slug) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('delete-listing', $listing->slug) }}" method="POST" onsubmit="return confirm('Are you sure to delete this listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-muted text-center py-4">No listings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
