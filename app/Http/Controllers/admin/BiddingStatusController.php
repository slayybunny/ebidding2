<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiddingStatusController extends Controller
{
    public function index()
    {
        // Dummy list of auctions
        $auctions = [
            [
                'id' => 1,
                'product_name' => 'Gold Bar 100g',
                'product_code' => 'GB100-001',
                'start_time' => '2025-08-01 10:00 AM',
                'end_time' => '2025-08-01 12:00 PM',
                'status' => 'Akan Bermula'
            ],
            [
                'id' => 2,
                'product_name' => 'Gold Coin 50g',
                'product_code' => 'GC50-002',
                'start_time' => '2025-07-31 09:00 AM',
                'end_time' => '2025-07-31 05:00 PM',
                'status' => 'Sedang Berlangsung'
            ],
            [
                'id' => 3,
                'product_name' => 'Gold Bar 250g',
                'product_code' => 'GB250-003',
                'start_time' => '2025-07-30 02:00 PM',
                'end_time' => '2025-07-30 04:00 PM',
                'status' => 'Telah Tamat'
            ],
        ];

        return view('admin.bidding-status.index', compact('auctions'));
    }

    public function show($id)
    {
        // Dummy auction data
        $auction = [
            'id' => $id,
            'product_name' => 'Gold Bar 100g',
            'product_code' => 'GB100-001',
            'start_time' => '2025-08-01 10:00 AM',
            'end_time' => '2025-08-01 12:00 PM',
            'status' => 'Akan Bermula',
            'highest_bid' => 'RM 8,500.00',
        ];

        // Dummy list of bids
        $bids = [
            ['name' => 'Ali Bin Abu', 'amount' => 'RM 8,500.00', 'time' => '2025-07-31 11:45 AM'],
            ['name' => 'Siti Aminah', 'amount' => 'RM 8,300.00', 'time' => '2025-07-31 11:20 AM'],
        ];

        return view('admin.bidding-status.show', compact('auction', 'bids'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:open,closed']);
        // Dummy update logic
        return redirect()->route('admin.bidding-status.index')->with('success', 'Status updated (dummy).');
    }
}
