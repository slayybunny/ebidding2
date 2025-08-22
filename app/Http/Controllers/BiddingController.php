<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BiddingController extends Controller
{
    /**
     * Show active listings that are not expired (Live Bidding)
     */
    public function index()
    {
        $now = Carbon::now();

        // Show only active listings that are currently live
        $listings = Listing::with('bids')
            ->where('status', 'active')
            ->whereRaw("CONCAT(start_date, ' ', start_time) <= ?", [$now])
            ->whereRaw("CONCAT(end_date, ' ', end_time) > ?", [$now])
            ->orderByDesc('created_at')
            ->get();

        return view('live-bidding', compact('listings'));
    }

    /**
     * Show details of a listing by ID (Fallback method)
     */
    public function show($id)
    {
        $listing = Listing::with(['bids.member', 'member'])->findOrFail($id);
        return view('bidding-detail', compact('listing'));
    }

    /**
     * Show details of a listing by SLUG
     */
    public function showBySlug($slug)
    {
        $listing = Listing::with(['bids.member', 'member'])->where('slug', $slug)->firstOrFail();

        // Calculate the end time of the listing based on new columns
        $endTime = Carbon::parse($listing->end_date . ' ' . $listing->end_time);

        if ($listing->status === 'unactive' || now()->greaterThanOrEqualTo($endTime)) {
            // If the bidding has ended, set the listing status to inactive
            $listing->status = 'unactive';
            $listing->save();
        }

        return view('bidding-detail', compact('listing'));
    }

    /**
     * Place a new bid
     */
    public function placeBid($slug, Request $request)
    {
        // Find the listing by slug
        $listing = Listing::where('slug', $slug)->firstOrFail();
        $user_id = Auth::id();

        // Validate the bid amount
        $request->validate([
            'bid_amount' => 'required|numeric|min:' . $listing->starting_price,
        ]);

        // Check if the user has already placed a bid
        $existingBid = Bid::where('listing_id', $listing->id)
                          ->where('member_id', $user_id)
                          ->first();

        if ($existingBid) {
            return back()->with('error', 'You have already placed a bid for this item.');
        }

        // Create a new bid
        $bid = new Bid();
        $bid->listing_id = $listing->id;
        $bid->member_id = $user_id;
        $bid->bid_price = $request->input('bid_amount');
        $bid->save();

        // Redirect or show success message
        return redirect()->route('bidding.live')->with('success', 'Bid placed successfully!');
    }

    /**
     * Show bidding history for the current user.
     */
    public function history()
    {
        $userId = Auth::id();
        $bids = Bid::where('member_id', $userId)
                   ->with(['listing', 'member'])
                   ->orderByDesc('created_at')
                   ->get();

        return view('history', compact('bids'));
    }

    /**
     * Show the bidding status page for a specific listing
     */
    public function showBiddingStatus()
    {
        $member = Auth::user();
        $bids = Bid::with('listing')->where('member_id', $member->id)->get();

        return view('status', compact('bids'));
    }

    /**
     * Method untuk membatalkan bidaan
     */
    public function cancel($bidId)
    {
        $bid = Bid::findOrFail($bidId);

        if ($bid->member_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this bid.');
        }

        $bid->delete();

        return redirect()->route('bidding.status')->with('success', 'Your bid has been cancelled successfully.');
    }
}
