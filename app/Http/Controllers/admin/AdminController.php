<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Listing;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Mendapatkan jumlah data daripada pangkalan data
        $activeUsers = Member::count();
        $submittedBids = Listing::count();
        $totalAdmins = Admin::count();

        // Data dummy untuk anugerah mingguan
        $weeklyAwards = 2;

        // Mengambil 5 lelongan terkini dengan data ahli
        $recentAuctions = Listing::with('member')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($listing) {
                // Menentukan status lelongan berdasarkan tarikh
                $now = Carbon::now();
                $start_time = Carbon::parse($listing->start_time);
                $end_time = Carbon::parse($listing->end_time);

                if ($now->lessThan($start_time)) {
                    $status = 'upcoming';
                } elseif ($now->greaterThanOrEqualTo($start_time) && $now->lessThanOrEqualTo($end_time)) {
                    $status = 'active';
                } else {
                    $status = 'completed';
                }

                return (object) [
                    'bidder_name' => $listing->member ? $listing->member->name : 'Unknown',
                    'product_name' => $listing->item,
                    'starting_price' => $listing->starting_price,
                    'status' => $status,
                ];
            });

        // Data dummy untuk carta kategori
        $categoryData = [
            'gold_necklace' => 40,
            'gold_ring' => 35,
            'gold_bar' => 25,
        ];

        // Menghantar data ke paparan dashboard
        return view('admin.dashboard', compact(
            'activeUsers',
            'submittedBids',
            'weeklyAwards',
            'recentAuctions',
            'categoryData',
            'totalAdmins'
        ));
    }
}
