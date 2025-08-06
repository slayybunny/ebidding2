<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Dummy data untuk tunjuk di dashboard (boleh sambung ke DB)
        $activeUsers = 10;
        $submittedBids = 5;
        $weeklyAwards = 2;

        $recentAuctions = [
            (object)[
                'bidder_name' => 'Siti Sarah',
                'product_name' => 'Gold Necklace',
                'starting_price' => 700,
                'status' => 'active',
            ],
            (object)[
                'bidder_name' => 'Ahmad Iqbal',
                'product_name' => 'Gold Ring',
                'starting_price' => 500,
                'status' => 'pending',
            ],
            (object)[
                'bidder_name' => 'John Doe',
                'product_name' => 'Gold Bar',
                'starting_price' => 400,
                'status' => 'closed',
            ],
        ];

        $categoryData = [
            'gold_necklace' => 40,
            'gold_ring' => 35,
            'gold_bar' => 25,
        ];

        return view('admin.dashboard', compact('activeUsers', 'submittedBids', 'weeklyAwards', 'recentAuctions', 'categoryData'));
    }
}
