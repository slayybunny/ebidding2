<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Listing;
use App\Models\Bid;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BiddingStatusController extends Controller
{
    public function index()
    {
        // Ambil semua lelongan dengan informasi member dan jumlah bidaan
        $auctions = Listing::with('member')
            ->withCount('bids') // Kekalkan ini, ia tidak mengganggu
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($auction) {
                // Tentukan status berdasarkan waktu
                $now = Carbon::now();
                $start_time = Carbon::parse($auction->start_time);
                $end_time = Carbon::parse($auction->end_time);

                if ($now->lessThan($start_time)) {
                    $status = 'upcoming';
                } elseif ($now->greaterThanOrEqualTo($start_time) && $now->lessThanOrEqualTo($end_time)) {
                    $status = 'active';
                } else {
                    $status = 'completed';
                }

                $auction->status = $status; // Tambah status ke objek lelongan
                return $auction;
            });

        return view('admin.bidding-status.index', compact('auctions'));
    }

    public function show($id)
{
    // Ambil satu lelongan dengan semua bidaan
    $auction = Listing::with(['bids.member', 'member'])->findOrFail($id);

    // Ambil bidaan dari objek lelongan
    $bids = $auction->bids;

    // Anda juga mungkin mahu mendapatkan bidaan tertinggi
    $highestBid = $auction->bids->sortByDesc('amount')->first();

    // Hantar kedua-dua 'auction' dan 'bids' ke paparan
    return view('admin.bidding-status.show', compact('auction', 'highestBid', 'bids'));
}
}
