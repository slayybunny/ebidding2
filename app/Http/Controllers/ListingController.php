<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ListingController extends Controller
{
    public function create()
    {
        return view('tender.create-listing');
    }

 public function store(Request $request)
{
    $request->validate([
        'item' => 'required|string|max:100',
        'type' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'starting_price' => 'required|numeric|min:0',
        'date' => 'required|date|after_or_equal:today',
        'duration_days' => 'nullable|integer|min:0|max:3',
        'duration_hours' => 'nullable|integer|min:0|max:23',
        'duration_minutes' => 'nullable|integer|min:0|max:59',
        'info' => 'required|string|max:200',
        'currency' => 'required|in:MYR,IDR',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    $days = (int) $request->input('duration_days', 0);
    $hours = (int) $request->input('duration_hours', 0);
    $minutes = (int) $request->input('duration_minutes', 0);
    $duration = $days * 1440 + $hours * 60 + $minutes;

    if ($duration < 1) {
        return back()->withErrors(['duration' => 'Minimum duration must be at least 1 minute.'])->withInput();
    }

    $currency = $request->currency;
    $price = $currency === 'IDR' ? round($request->price) : number_format($request->price, 2, '.', '');
    $starting_price = $currency === 'IDR' ? round($request->starting_price) : number_format($request->starting_price, 2, '.', '');

    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
    }

    $dateWithTime = Carbon::parse($request->date)->setTimeFrom(Carbon::now());

    Listing::create([
        'member_id' => Auth::id(),
        'item' => $request->item,
        'type' => $request->type,
        'price' => $price,
        'starting_price' => $starting_price,
        'currency' => $currency,
        'date' => $dateWithTime,
        'duration' => $duration,
        'info' => $request->info,
        'image' => $imagePath,
        'status' => 'active',
        'slug' => Str::slug($request->item . '-' . uniqid())
    ]);

    return redirect()->route('my-gold-items')->with('success', 'Listing created successfully.');
}

public function myGoldItems()
{
    $goldListings = Listing::where('member_id', Auth::id())->get();
    $now = Carbon::now();

    foreach ($goldListings as $listing) {
        // Kalau end_time null, kira semula guna date + duration
        if (empty($listing->end_time) && !empty($listing->date) && !empty($listing->duration)) {
            $listing->end_time = Carbon::parse($listing->date)->addMinutes($listing->duration);
            $listing->save();
        }

        // Pastikan end_time bukan null sebelum compare
        if ($listing->end_time && $listing->status === 'active' && $now->greaterThanOrEqualTo($listing->end_time)) {
            $listing->status = 'unactive';
            $listing->save();
        }
    }

    return view('tender.my-gold-items', compact('goldListings'));
}

public function overview()
{
    $now = Carbon::now();

    // Ambil semua listing milik user login
    $listings = Listing::with('bids')
        ->where('member_id', Auth::id())
        ->orderByDesc('date')
        ->get();

    foreach ($listings as $listing) {
        // Kira end_time kalau kosong dan simpan ke database
        if (empty($listing->end_time)) {
            $listing->end_time = Carbon::parse($listing->date)->addMinutes($listing->duration);
            $listing->save();
        }

        $bids = $listing->bids->sortByDesc('bid_price');
        $isExpired = $now->greaterThanOrEqualTo($listing->end_time);

        // Tukar status jadi unactive bila expired & pastikan end_time konsisten
        if ($isExpired && $listing->status === 'active') {
            $listing->status = 'unactive';
            $listing->end_time = $listing->end_time ?? Carbon::parse($listing->date)->addMinutes($listing->duration);
            $listing->save();
        }

        // Tentukan pemenang bila expired & belum ada winner
        if ($isExpired && $bids->isNotEmpty() && $listing->bids->where('status', 'winner')->isEmpty()) {
            $winnerBid = $bids->first();
            $winnerBid->status = 'winner';
            $winnerBid->save();

            foreach ($bids->skip(1) as $loseBid) {
                $loseBid->status = 'lose';
                $loseBid->save();
            }
        }
    }

    return view('tender.listing-overview', compact('listings'));
}




public function liveBidding()
{
    $now = Carbon::now();

    // Ambil semua listing yang belum tamat berdasarkan end_time atau duration
    $listings = Listing::where('status', 'active')
        ->where('date', '<=', $now)
        ->get()
        ->filter(function ($listing) use ($now) {
            // Kira end_time kalau kosong
            if (empty($listing->end_time)) {
                $listing->end_time = Carbon::parse($listing->date)->addMinutes($listing->duration);
                $listing->save();
            }

            // Kalau dah tamat, update status
            if ($listing->end_time->lte($now) && $listing->status === 'active') {
                $listing->status = 'unactive';
                $listing->save();
            }

            // Return listing yang masih live sahaja
            return $listing->status === 'active' && $listing->end_time->gt($now);
        });

    return view('live-bidding', compact('listings'));
}


    public function listingOverviewAll()
    {
        $listings = Listing::with(['bids.member'])
            ->where('member_id', Auth::id())
            ->orderByDesc('date')
            ->get();
        $now = Carbon::now();

        foreach ($listings as $listing) {
            $endTime = Carbon::parse($listing->date)->addMinutes($listing->duration);

            if ($now->greaterThanOrEqualTo($endTime) && $listing->status === 'active') {
                $listing->status = 'unactive';
                $listing->save();
            }
            if ($now->greaterThanOrEqualTo($endTime) && $listing->bids->isNotEmpty() && $listing->bids->where('status', 'winner')->isEmpty()) {
                $winnerBid = $listing->bids->sortByDesc('bid_price')->first();
                if ($winnerBid) {
                    $winnerBid->status = 'winner';
                    $winnerBid->save();
                }
                foreach ($listing->bids as $bid) {
                    if ($bid->id !== optional($winnerBid)->id) {
                        $bid->status = 'lose';
                        $bid->save();
                    }
                }
            }
        }
        return view('tender.listing-overview', compact('listings'));
    }

    public function biddingHistory()
    {
        $userId = Auth::id();
        $listings = Listing::where('status', 'unactive')
            ->whereHas('bids', function ($query) use ($userId) {
                $query->where('member_id', $userId);
            })
            ->get();
        return view('bidding.history', compact('listings'));
    }

public function edit($slug)
{
    $listing = Listing::where('slug', $slug)->firstOrFail();
    return view('tender.edit-listing', compact('listing'));
}

public function update(Request $request, $slug)
{
    $listing = Listing::where('slug', $slug)->firstOrFail();

    $validated = $request->validate([
        'item' => 'required|string|max:100',
        'type' => 'nullable|string|max:100',
        'price' => 'nullable|numeric',
        'starting_price' => 'nullable|numeric',
        'date' => 'nullable|date',
        'duration_days' => 'nullable|integer|min:0|max:3',
        'duration_hours' => 'nullable|integer|min:0|max:23',
        'duration_minutes' => 'nullable|integer|min:0|max:59',
        'info' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'currency' => 'nullable|string|max:3',
    ]);

    // Handle image
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $validated['image'] = 'images/' . $filename;
    } else {
        $validated['image'] = $listing->image;
    }

    // Date
    $newDate = !empty($validated['date']) ? Carbon::parse($validated['date']) : Carbon::parse($listing->date);

    // Duration
    $days = (int) $request->input('duration_days', 0);
    $hours = (int) $request->input('duration_hours', 0);
    $minutes = (int) $request->input('duration_minutes', 0);
    $newDuration = $days * 1440 + $hours * 60 + $minutes;
    if ($newDuration < 1) $newDuration = $listing->duration; // fallback

    $validated['duration'] = $newDuration;
    $validated['end_time'] = $newDate->copy()->addMinutes($newDuration);
    $validated['date'] = $newDate;

    $listing->update($validated);

    return redirect()->route('my-gold-items')->with('success', 'Listing updated successfully.');
}

    public function destroy($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();
        if ($listing->member_id !== Auth::id()) {
            abort(403);
        }
        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }
        $listing->delete();
        return redirect()->route('my-gold-items')->with('success', 'Listing deleted successfully.');
    }

    public function status()
    {
        $userId = auth()->id();
        $listings = Listing::whereHas('bids', function ($query) use ($userId) {
            $query->where('member_id', $userId);
        })
        ->with(['bids' => function ($query) use ($userId) {
            $query->where('member_id', $userId)->orderByDesc('bid_price');
        }])
        ->get();

        return view('status', compact('listings'));
    }


    public function winner()
    {
        $winners = Bid::where('status', 'winner')->with(['member', 'listing'])->get();
        return view('winner', compact('winners'));
    }
}
