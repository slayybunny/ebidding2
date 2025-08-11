<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Bid;
use App\Models\Listing;
use App\Models\Member;

class ToyyibpayController extends Controller
{
    /**
     * Create a ToyyibPay payment bill
     */
    public function create($listingId)
    {
        $listing = Listing::findOrFail($listingId);

        // Pastikan ambil bid dari user login
        $userBid = Bid::where('listing_id', $listingId)
            ->where('member_id', Auth::id())
            ->firstOrFail();

        // Dapatkan maklumat member login
        $member = Member::findOrFail(Auth::id());

        // Hadkan billName kepada maksimum 30 aksara
        $billName = Str::limit('Payment for ' . $listing->item, 30, '');

        // Call ToyyibPay API untuk create bill
        $response = Http::asForm()->post('https://toyyibpay.com/index.php/api/createBill', [
            'userSecretKey'     => config('toyyibpay.key'),
            'categoryCode'      => config('toyyibpay.category'),
            'billName'          => $billName,
            'billDescription'   => 'Bid payment for listing',
            'billPriceSetting'  => 1,
            'billPayorInfo'     => 1,
            'billAmount'        => $userBid->bid_price * 100,
            'billReturnUrl'     => route('payment.redirect', ['bidId' => $userBid->id]),
            'billCallbackUrl'   => route('payment.callback'),
            'billExternalReferenceNo' => $listingId,
            'billTo'            => $member->name,
            'billEmail'         => $member->email,
            'billPhone'         => $member->phone,
            'billExpiryDate'    => now()->addDays(3)->format('Y-m-d'),
            'billExpiryDays'    => 3,
            'billPaymentChannel'=> 2,
            'billChargeToCustomer' => 1
        ]);

        $result = $response->json();
        Log::info('ToyyibPay API Response', $result);

        if (!empty($result[0]['BillCode'])) {
            $billCode = $result[0]['BillCode'];

            // Simpan ke session untuk fallback
            session(['toyyibpay_billcode' => $billCode]);

            return redirect()->away("https://toyyibpay.com/$billCode");
        }

        return back()->with('error', 'Failed to create payment bill. Response: ' . json_encode($result));
    }

    /**
     * Show payment status
     */
    public function paymentStatus()
    {
        $listings = Listing::whereHas('bids', function ($query) {
            $query->where('member_id', Auth::id());
        })->with(['bids' => function ($query) {
            $query->where('member_id', Auth::id());
        }])->get();

        return view('status', compact('listings'));
    }

    /**
     * Callback dari ToyyibPay
     */
    public function callback(Request $request)
    {
        Log::info('ToyyibPay Callback', $request->all());

        if ($request->status === '1') {
            Listing::where('id', $request->order_id)->update(['is_paid' => true]);
        }

        return response()->json(['message' => 'Callback received']);
    }

    /**
     * Redirect selepas bayar atau cancel
     */
    public function redirectAfterPayment(Request $request, $bidId)
    {
        $statusId = $request->get('status_id');
        $billCode = $request->get('billcode') ?? session('toyyibpay_billcode');

        $bid = Bid::find($bidId);
        $listingId = $bid ? $bid->listing_id : null;

        if ($statusId == 1 && $bid) {
            // Link resit ToyyibPay
            $receiptUrl = "https://toyyibpay.com/" . $billCode;

            // Update status & simpan link resit dalam DB
            Listing::where('id', $listingId)->update([
                'is_paid' => true,
                'receipt_url' => $receiptUrl
            ]);

            return redirect()->route('payment.status')
                ->with('success', '✅ Payment successful! Thank you for your payment.');
        } else {
            return redirect()->route('payment.status')
                ->with('error', '❌ Payment was cancelled or failed. Please try again.');
        }
    }

    public function receipt($id)
    {
        $listing = Listing::findOrFail($id);

        if (!$listing->is_paid) {
            abort(403, 'Receipt not available.');
        }

        // Return PDF or stored receipt file
        return response()->file(storage_path("app/receipts/{$listing->id}.pdf"));
    }
}
