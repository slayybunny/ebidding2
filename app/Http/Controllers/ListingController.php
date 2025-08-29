<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;
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
            'item'           => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'starting_price' => 'required|numeric|min:0',
            'currency'       => 'required|string|max:10',
            'info'           => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'start_date'     => 'required|date_format:Y-m-d',
            'start_time'     => 'required|date_format:H:i',
            'duration_days'  => 'nullable|integer|min:1',
            'end_date'       => 'nullable|date_format:Y-m-d',
            'end_time'       => 'nullable|date_format:H:i',
        ]);

        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $filename  = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        // Slug unik
        $slug = Str::slug($request->item) . '-' . Str::random(6);

        // Gabung tarikh + masa mula
        $startAt = Carbon::createFromFormat('Y-m-d H:i', $request->start_date.' '.$request->start_time, 'Asia/Kuala_Lumpur');

        // Tentukan tarikh tamat
        if (filled($request->duration_days)) {
            $endAt = (clone $startAt)->addDays((int)$request->duration_days);
        } else {
            $endDateStr = $request->end_date ?: $request->start_date;
            $endTimeStr = $request->end_time ?: $request->start_time;
            $endAt = Carbon::createFromFormat('Y-m-d H:i', $endDateStr.' '.$endTimeStr, 'Asia/Kuala_Lumpur');
        }

        if ($endAt->lte($startAt)) {
            return back()->withErrors(['end_time' => 'End datetime must be after start datetime.'])->withInput();
        }

        // Simpan dalam DB
        Listing::create([
            'member_id'      => auth()->id(),
            'item'           => $request->item,
            'type'           => $request->type,
            'price'          => $request->price,
            'starting_price' => $request->starting_price,
            'currency'       => $request->currency,
            'info'           => $request->info,
            'image'          => $imagePath,
            'slug'           => $slug,

            // Tarikh & masa asing
            'start_date'     => $startAt->toDateString(),
            'start_time'     => $startAt->format('H:i:s'),
            'end_date'       => $endAt->toDateString(),
            'end_time'       => $endAt->format('H:i:s'),

            // Status auto
            'status'         => now()->between($startAt, $endAt) ? 'PENDING' : 'ENDED',
        ]);

        return redirect()->route('my-gold-items')->with('success', 'Listing created successfully!');
    }

    public function myGoldItems()
    {
        $goldListings = Listing::where('member_id', Auth::id())->get();
        $now = Carbon::now();

        foreach ($goldListings as $listing) {
            $endAt = Carbon::parse($listing->end_date.' '.$listing->end_time);
            if ($listing->status === 'active' && $now->gte($endAt)) {
                $listing->status = 'unactive';
                $listing->save();
            }
        }

        return view('tender.my-gold-items', compact('goldListings'));
    }

    public function overview()
    {
        $now = Carbon::now();
        $listings = Listing::with('bids')
            ->where('member_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        foreach ($listings as $listing) {
            $endAt = Carbon::parse($listing->end_date.' '.$listing->end_time);
            $bids = $listing->bids->sortByDesc('bid_price');
            $isExpired = $now->gte($endAt);

            if ($isExpired && $listing->status === 'active') {
                $listing->status = 'unactive';
                $listing->save();
            }

            if ($isExpired && $bids->isNotEmpty() && $listing->bids->where('status','winner')->isEmpty()) {
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

        // Ambil listings yang status active dan belum tamat
        $listings = Listing::where('status', 'active')
            ->where('end_date', '>=', $now->toDateString())
            ->where('start_date', '<=', $now->toDateString())
            ->whereRaw("CONCAT(start_date, ' ', start_time) <= ?", [$now])
            ->whereRaw("CONCAT(end_date, ' ', end_time) > ?", [$now])
            ->orderByDesc('start_date')
            ->orderByDesc('start_time')
            ->get();

        return view('live-bidding', compact('listings'));
    }


    public function listingOverviewAll()
    {
        $listings = Listing::with(['bids.member'])
            ->where('member_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        $now = Carbon::now();

        foreach ($listings as $listing) {
            $endAt = Carbon::parse($listing->end_date.' '.$listing->end_time);

            if ($listing->status === 'active' && $now->gte($endAt)) {
                $listing->status = 'unactive';
                $listing->save();
            }

            if ($now->gte($endAt) && $listing->bids->isNotEmpty() && $listing->bids->where('status','winner')->isEmpty()) {
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
        $listings = Listing::where('status','unactive')
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
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:'.$request->start_date,
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'info' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'currency' => 'nullable|string|max:3',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validated['image'] = 'images/'.$filename;
        } else {
            $validated['image'] = $listing->image;
        }

        $startAt = Carbon::parse($validated['start_date'].' '.$validated['start_time']);
        $endAt   = Carbon::parse($validated['end_date'].' '.$validated['end_time']);

        if ($endAt->lte($startAt)) {
            return back()->withErrors(['end_time' => 'End datetime must be after start datetime.'])->withInput();
        }

        $validated['status'] = now()->between($startAt, $endAt) ? 'active' : 'unactive';

        $listing->update($validated);

        return redirect()->route('my-gold-items')->with('success', 'Listing updated successfully.');
    }

    public function destroy($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();
        if ($listing->member_id !== Auth::id()) {
            abort(403);
        }
        if ($listing->image && file_exists(public_path($listing->image))) {
            unlink(public_path($listing->image));
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
        $winners = Bid::where('status', 'winner')->with(['member','listing'])->get();
        return view('winner', compact('winners'));
    }
}
