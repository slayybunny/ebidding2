<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Carbon\Carbon;

class BiddingStatusController extends Controller
{
    /**
     * Tunjukkan halaman status lelongan dengan semua senarai item.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    $now = Carbon::now();

    // Ambil hanya lelongan yang sedang aktif/berjalan.
    // Menggunakan created_at kerana start_time tidak wujud.
    $auctions = Listing::with('member')
        ->where('created_at', '<=', $now)
        ->where('end_time', '>=', $now)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.bidding-status.index', compact('auctions'));
}

    /**
     * Tunjukkan butiran lelongan untuk satu item.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Kod ini tidak perlu diubah kerana ia berfungsi dengan baik
        $listing = Listing::with(['bids.member', 'member'])->findOrFail($id);
        $bids = $listing->bids;
        $highestBid = $bids->sortByDesc('bid_price')->first();
        $currentPrice = $highestBid ? $highestBid->bid_price : $listing->starting_price;
        return view('admin.bidding-status.show', compact('listing', 'highestBid', 'bids', 'currentPrice'));
    }
}