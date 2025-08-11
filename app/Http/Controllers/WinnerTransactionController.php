<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WinnerTransactionController extends Controller
{
    public function index()
    {
        // Dapatkan member_id — sokong dua kemungkinan struktur
        $authUser = Auth::user();
        $memberId = $authUser->member_id ?? $authUser->id;

       $winnerTransactions = DB::table('bids')
    ->select(
        'bids.id as bid_id',
        'bids.member_id',
        'members.name',
        'listings.id as listing_id',
        'listings.item',
        'listings.type',
        'bids.bid_price',
        'listings.date',
        'listings.info',
        'listings.image',
        'listings.is_paid',
        'listings.receipt_url',
        'bids.created_at as bid_created_at'
    )
    ->join('members', 'bids.member_id', '=', 'members.id')
    ->join('listings', 'bids.listing_id', '=', 'listings.id')
    ->where('bids.member_id', $memberId)
    ->where('bids.status', 'winner')
    ->orderByDesc('listings.date')
    ->get();

        return view('tender.winner-transactions', compact('winnerTransactions'));
    }
}
