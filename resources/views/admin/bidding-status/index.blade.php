@extends('layouts.admin.app')

@section('page-title', 'BIDDING STATUS')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body px-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-semibold text-dark mb-0">
                        <i class="fas fa-gavel me-2 text-gold"></i>Auction Status
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead class="border-bottom text-muted small text-uppercase">
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($auctions as $auction)
                                <tr class="bg-white shadow-sm rounded-3 mb-2">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $auction->product_name }}</div>
                                        <small class="text-muted">Code: {{ $auction->slug }}</small><br>
                                        {{-- Warna teks Tender kepada warna gold gelap --}}
                                        <small class="text-gold">Tender: {{ $auction->member->name }}</small>
                                    </td>
                                    {{-- Menggunakan created_at untuk Start Date --}}
                                    <td>{{ \Carbon\Carbon::parse($auction->created_at)->format('Y-m-d h:i A') }}</td>
                                    {{-- Menggunakan end_time untuk End Date --}}
                                    <td>{{ \Carbon\Carbon::parse($auction->end_time)->format('Y-m-d h:i A') }}</td>
                                    <td>
                                        {{-- Logik Status yang diperbaiki --}}
                                        @if (\Carbon\Carbon::now()->isBefore($auction->end_time))
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                <i class="fas fa-play me-1"></i> Ongoing
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i> Completed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{-- Warna button View kepada warna gold gelap --}}
                                        <a href="{{ route('admin.bidding-status.show', $auction->id) }}"
                                            class="btn btn-sm btn-outline-gold rounded-pill px-3">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white shadow-sm rounded-3 mb-2">
                                    {{-- Kolspan kembali ke 6 kerana lajur Bids dibuang --}}
                                    <td colspan="6" class="text-center text-muted py-4">No auction data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah style untuk warna gold gelap --}}
    <style>
        :root {
            --bs-gold: #B8860B;
        }

        .text-gold {
            color: var(--bs-gold) !important;
        }

        .btn-outline-gold {
            color: var(--bs-gold);
            border-color: var(--bs-gold);
        }

        .btn-outline-gold:hover {
            color: #fff;
            background-color: var(--bs-gold);
        }

        .bg-gold-light {
            background-color: rgba(184, 134, 11, 0.1);
        }
    </style>
@endsection