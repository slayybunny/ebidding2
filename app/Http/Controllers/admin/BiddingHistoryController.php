<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;

class BiddingHistoryController extends Controller
{
    /**
     * Display a listing of the bidding history for admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua bids bersama nama produk auction
        $bids = Bid::with('auction')->latest()->paginate(10);

        return view('admin.bidding-history.index', compact('bids'));
    }
}
