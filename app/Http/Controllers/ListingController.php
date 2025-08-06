<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ListingController extends Controller
{
    // Show the form to create a new listing
    public function create()
    {
        return view('tender.create-listing');
    }

    // Store a newly created listing in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'item' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric',
            'starting_price' => 'required|numeric',
            'date' => 'required|date|after_or_equal:today', // Tarikh mesti tidak lebih dari hari ini
            'duration_days' => 'nullable|integer|min:0|max:3',
            'duration_hours' => 'nullable|integer|min:0|max:23',
            'duration_minutes' => 'nullable|integer|min:0|max:59',
            'info' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Calculate total duration in minutes
        $days = (int) $request->input('duration_days', 0);
        $hours = (int) $request->input('duration_hours', 0);
        $minutes = (int) $request->input('duration_minutes', 0);
        $duration = $days * 1440 + $hours * 60 + $minutes;

        // Ensure the duration does not exceed 3 days (4320 minutes)
        if ($duration > 4320) {
            return back()->with('error', 'Duration cannot exceed 3 days.');
        }

        // Determine listing status based on duration
        $status = $duration > 0 ? 'active' : 'unactive';

        // Handle image upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/listings', 'public');
        }

        // Create a new listing
        Listing::create([
            'member_id' => Auth::id(),
            'item' => $request->item,
            'type' => $request->type,
            'price' => $request->price,
            'starting_price' => $request->starting_price,
            'date' => $request->date,
            'duration' => $duration,
            'info' => $request->info,
            'image' => $imagePath,
            'currency' => $request->currency ?? 'MYR',
            'status' => $status,
            'slug' => Str::slug($request->item . '-' . uniqid()) // Generate unique slug
        ]);

        return redirect()->route('my-gold-items')->with('success', 'Listing created successfully.');
    }

    // Show all gold items of the logged-in user, regardless of status
    public function myGoldItems()
{
    $goldListings = Listing::where('member_id', Auth::id())->get();

    return view('tender.my-gold-items', compact('goldListings'));
}



    // Show the overview of a specific listing
    // ListingController.php
public function overview($slug)
{
    // Dapatkan listing berdasarkan slug
    $listing = Listing::where('slug', $slug)->where('member_id', Auth::id())->first();

    // Kalau tiada listing ditemui
    if (!$listing) {
        return view('tender.listing-overview', [
            'listing' => null,
            'bids' => collect()
        ]);
    }

    // Dapatkan bids yang berkaitan
    $bids = $listing->bids()->latest()->get();

    return view('tender.listing-overview', compact('listing', 'bids'));
}


    // Show active listings for live bidding
    public function liveBidding()
    {
        $now = Carbon::now();  // Get current time

        // Fetch active listings that are still valid
        $listings = Listing::where('status', 'active')
            ->where(function ($query) use ($now) {
                $query->whereRaw("TIMESTAMPADD(MINUTE, duration, date) > ?", [$now])  // Check if the listing is still within the bidding period
                      ->orWhere('date', '<=', $now);  // Allow products with start date <= current time
            })
            ->get();

        return view('bidding.live', compact('listings'));
    }

    // Show bidding history (only the listings the user has bid on)
    public function biddingHistory()
    {
        $userId = Auth::id();

        // Fetch listings where the user has placed a bid and the status is 'unactive'
        $listings = Listing::where('status', 'unactive')
            ->whereHas('bids', function ($query) use ($userId) {
                $query->where('member_id', $userId);  // Ensure the user has placed a bid
            })
            ->get();

        return view('bidding.history', compact('listings'));
    }

    // Show the form to edit an existing listing
    public function edit($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail(); // Get the listing based on the slug
        return view('tender.edit-listing', compact('listing'));
    }

    // Update an existing listing in the database
    public function update(Request $request, $slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();

        // Validate the incoming data
        $validated = $request->validate([
            'item' => 'required|string|max:100',
            'type' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'starting_price' => 'nullable|numeric',
            'date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'info' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'currency' => 'nullable|string|max:3',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('listings', 'public');
            $validated['image'] = $path;
        }

        // Update the listing
        $listing->update($validated);

        return redirect()->route('my-gold-items')->with('success', 'Listing updated successfully.');
    }

    // Delete a specific listing
    public function destroy($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();

        // Ensure the logged-in user is the owner of the listing
        if ($listing->member_id !== Auth::id()) {
            abort(403);
        }

        // Delete the image if it exists
        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }

        // Delete the listing from the database
        $listing->delete();

        return redirect()->route('my-gold-items')->with('success', 'Listing deleted successfully.');
    }
}
