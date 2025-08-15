<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bid;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BiddingPlatformController extends Controller
{
    /**
     * Paparkan senarai sumber.
     */
    public function index()
    {
        $biddings = Listing::all();
        foreach ($biddings as $bidding) {
            $this->setBiddingStatus($bidding);
        }

        return view('admin.bidding-platform.index', compact('biddings'));
    }

    /**
     * Paparkan borang untuk mencipta sumber baru.
     */
    public function create()
    {
        return view('admin.bidding-platform.create');
    }

    /**
     * Simpan sumber baru ke dalam pangkalan data.
     */
    public function store(Request $request)
    {
        // Gunakan validation request secara terus
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'net_weight' => 'required|string',
            'purity_level' => 'required|string',
            'category' => 'required|string',
            'starting_price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // Tambah validasi untuk gambar
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses muat naik gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/bidding_images', 'public');
        }

        // Cipta Listing baru dengan data yang divalidasi
        $bidding = Listing::create([
            'item' => $validatedData['item'],
            'net_weight' => $validatedData['net_weight'],
            'purity_level' => $validatedData['purity_level'],
            'category' => $validatedData['category'],
            'starting_price' => $validatedData['starting_price'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'image_url' => $imagePath, // Simpan laluan gambar
            'status' => 'PENDING',
        ]);

        return redirect()->route('admin.bidding.index')->with('success', 'Bidaan baru berjaya ditambah.');
    }

    /**
     * Paparkan sumber yang ditentukan.
     */
    public function show($id)
    {
        // Muat objek Listing dan hubungannya sekali
        $bidding = Listing::with(['bids' => function ($query) {
            $query->orderBy('bid_price', 'desc');
        }])->findOrFail($id);

        // Panggil fungsi setBiddingStatus untuk memastikan status dikemas kini sebelum dipaparkan
        $this->setBiddingStatus($bidding);

        $winner = null;
        $currentBids = collect();

        // Dapatkan maklumat bidaan
        $bidding->number_of_bidders = $bidding->bids->unique('member_id')->count();
        $bidding->total_bids = $bidding->bids->count();

        // Logik baharu: Bidaan tertinggi hanya wujud jika ada bidaan
        $bidding->highest_bid = $bidding->bids->first()->bid_price ?? null;

        // Kira peratus peningkatan
        if ($bidding->highest_bid && $bidding->starting_price > 0 && $bidding->highest_bid > $bidding->starting_price) {
            $bidding->percentage_increase = (($bidding->highest_bid - $bidding->starting_price) / $bidding->starting_price) * 100;
        } else {
            $bidding->percentage_increase = 0;
        }

        // Semak status bidaan yang telah dikemas kini
        if ($bidding->status === 'COMPLETED') {
            $winningBid = $bidding->bids->first();
            if ($winningBid) {
                // Gunakan hubungan eloquent untuk mendapatkan pengguna
                $winningUser = User::find($winningBid->member_id);
                $winner = (object) [
                    'name' => $winningUser->name ?? 'N/A',
                    'user_id' => $winningBid->member_id,
                    'final_bid' => $winningBid->bid_price,
                    'bid_time' => $winningBid->created_at,
                ];
            }
        } else {
            // Untuk bidaan yang masih ONGOING, kita senaraikan bidaan-bidaan semasa
            $currentBids = $bidding->bids->map(function ($bid) {
                $user = User::find($bid->member_id);
                return (object) [
                    'name' => $user->name ?? 'N/A',
                    'user_id' => $bid->member_id,
                    'amount' => $bid->bid_price,
                    'bid_time' => $bid->created_at,
                ];
            });
        }

        return view('admin.bidding-platform.show', compact('bidding', 'winner', 'currentBids'));
    }

    /**
     * Paparkan borang untuk mengemaskini sumber yang ditentukan.
     */

    /**
     * Kemaskini sumber yang ditentukan dalam pangkalan data.
     */


    /**
     * Buang sumber yang ditentukan dari pangkalan data.
     */
    public function destroy($id)
    {
        $bidding = Listing::findOrFail($id);

        // Hapus imej jika wujud
        if ($bidding->image_url) {
            Storage::disk('public')->delete($bidding->image_url);
        }

        $bidding->delete();
        return redirect()->route('admin.bidding.index')->with('success', 'Bidaan berjaya dipadam.');
    }

    /**
     * Fungsi pembantu untuk mengemaskini status bidaan berdasarkan tarikh dan masa.
     */
    private function setBiddingStatus($bidding)
    {
        $now = Carbon::now();
        $startDate = Carbon::parse($bidding->start_date);
        $endDate = Carbon::parse($bidding->end_date);

        if ($now->greaterThanOrEqualTo($endDate)) {
            // Jika masa tamat telah berlalu
            $bidding->status = 'COMPLETED';
        } elseif ($now->greaterThanOrEqualTo($startDate) && $now->lessThan($endDate)) {
            // Jika masa bidaan sedang berjalan
            $bidding->status = 'ONGOING';
        } else {
            // Jika masa bidaan belum bermula
            $bidding->status = 'PENDING';
        }

        // Hanya simpan jika status telah berubah untuk mengelakkan kemaskini yang tidak perlu
        if ($bidding->isDirty('status')) {
            $bidding->save();
        }
    }
}
