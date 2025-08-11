<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function view($page)
    {
        $allowedPages = [
            'create-listing',
            'my-gold-items',
            'listing-overview',
            'ongoing-bids',
            'my-bids',
            'bid-management',
            'offers-received',
            'account-profile',
            'interested-bidders',
            'user-list',
            'bid-history',
            'transaction-history',
            'closed-listings',
            'delivery-status',
            'tracking-updates',
            'fulfilled-orders',
            'alerts',
            'messages',
            'activity-history',
            'settings',
            'permissions',
        ];

        if (in_array($page, $allowedPages)) {
            return view("tender.$page");
        }

        abort(404);
    }

    public function winnerTransactions()
{
    $transactions = \App\Models\Bid::with('listing')
        ->where('member_id', auth()->id())
        ->where('status', 'winner')
        ->get();

    return view('tender.winner-transactions', compact('transactions'));
}

}
