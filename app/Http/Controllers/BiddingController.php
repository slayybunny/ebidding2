<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid; // Make sure to use the correct Bid model
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BiddingController extends Controller
{
    /**
     * Show active listings that are not expired (Live Bidding)
     */
    public function index()
    {
        $listings = Listing::all();
        $now = Carbon::now();

        // Show only active listings that haven't expired
        $listings = Listing::where('status', 'active')
            ->whereRaw("TIMESTAMPADD(MINUTE, duration, date) > ?", [$now])
            ->orderBy('date', 'desc')
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

        // Calculate the end time of the listing
        $endTime = Carbon::parse($listing->date)->addMinutes($listing->duration);

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

        // Validate the bid amount
        $request->validate([
            'bid_amount' => 'required|numeric|min:' . $listing->starting_price, // Minimum bid must be at least the starting price
        ]);

        // Create a new bid
        $bid = new Bid();
        $bid->listing_id = $listing->id;
        $bid->member_id = Auth::id(); // Assuming member_id is the authenticated user's ID
        $bid->bid_price = $request->input('bid_amount');
        $bid->save();

        // Redirect or show success message
        return redirect()->route('bidding.live')->with('success', 'Bid placed successfully!');
    }

    /**
     * Show bidding history (for completed bids)
     */
     public function history()
    {
        $bids = Bid::where('member_id', Auth::id())
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
        $member = auth()->user();  // Use auth()->user() to get the currently logged-in member.
        $bids = Bid::with('listing')->where('member_id', $member->id)->get(); // Use member_id from auth

        return view('status', compact('bids'));
    }

     // Method untuk membatalkan bidaan
    public function cancel($bidId)
    {
        // Cari bidaan berdasarkan ID
        $bid = Bid::findOrFail($bidId);

        // Pastikan hanya pengguna yang membuat bidaan ini boleh membatalkannya
        if ($bid->member_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this bid.');
        }

        // Hapuskan bidaan dari database
        $bid->delete();

        return redirect()->route('bidding.status')->with('success', 'Your bid has been cancelled successfully.');
    }

}
