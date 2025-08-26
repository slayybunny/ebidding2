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
     * Create a ToyyibPay payment bill for bidding
     */
    public function create($listingId)
    {
        $listing = Listing::findOrFail($listingId);

        // Ambil bid dari user login
        $userBid = Bid::where('listing_id', $listingId)
            ->where('member_id', Auth::id())
            ->firstOrFail();

        // Maklumat member
        $member = Member::findOrFail(Auth::id());

        // Nama bill
        $billName = Str::limit('Payment for ' . $listing->item, 30, '');

        // Call ToyyibPay API
        $response = Http::asForm()->post(config('toyyibpay.url').'/index.php/api/createBill', [
            'userSecretKey'     => config('toyyibpay.key'),
            'categoryCode'      => config('toyyibpay.category'), // Bid category
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
            session(['toyyibpay_billcode' => $billCode]);

            return redirect()->away(config('toyyibpay.url')."/$billCode");
        }

        return back()->with('error', 'Failed to create payment bill. Response: ' . json_encode($result));
    }

    /**
     * Create a fixed RM10 payment (different category)
     */
    public function createFixedPayment()
    {
        // Maklumat member login
        $member = Member::findOrFail(Auth::id());

        $billName = 'Fixed Payment RM10';

        // Call ToyyibPay API
        $response = Http::asForm()->post(config('toyyibpay.url').'/index.php/api/createBill', [
            'userSecretKey'     => config('toyyibpay.key'),
            'categoryCode'      => config('toyyibpay.fixed_category'), // RM10 fixed category
            'billName'          => $billName,
            'billDescription'   => 'Fixed RM10 payment',
            'billPriceSetting'  => 1,
            'billPayorInfo'     => 1,
            'billAmount'        => 10 * 100, // RM10
            'billReturnUrl'     => route('payment.redirect.fixed'),
            'billCallbackUrl'   => route('payment.callback'),
            'billExternalReferenceNo' => 'FIXED-' . time(),
            'billTo'            => $member->name,
            'billEmail'         => $member->email,
            'billPhone'         => $member->phone,
            'billExpiryDate'    => now()->addDays(3)->format('Y-m-d'),
            'billExpiryDays'    => 3,
            'billPaymentChannel'=> 2,
            'billChargeToCustomer' => 1
        ]);

        $result = $response->json();
        Log::info('ToyyibPay Fixed RM10 Response', $result);

        if (!empty($result[0]['BillCode'])) {
            $billCode = $result[0]['BillCode'];
            session(['toyyibpay_billcode_fixed' => $billCode]);

            return redirect()->away(config('toyyibpay.url')."/$billCode");
        }

        return back()->with('error', 'Failed to create fixed RM10 payment. Response: ' . json_encode($result));
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
     * Redirect selepas bayar atau cancel untuk bid payment
     */
    public function redirectAfterPayment(Request $request, $bidId)
    {
        $statusId = $request->get('status_id');
        $billCode = $request->get('billcode') ?? session('toyyibpay_billcode');

        $bid = Bid::find($bidId);
        $listingId = $bid ? $bid->listing_id : null;

        if ($statusId == 1 && $bid) {
            $receiptUrl = config('toyyibpay.url') . $billCode;

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

    /**
     * Redirect selepas bayar atau cancel untuk fixed RM10 payment
     */
    public function redirectAfterFixedPayment(Request $request)
    {
        $statusId = $request->get('status_id');
        $billCode = $request->get('billcode') ?? session('toyyibpay_billcode_fixed');

        if ($statusId == 1) {
            return redirect()->route('payment.status')
                ->with('success', '✅ Fixed RM10 payment successful!');
        } else {
            return redirect()->route('payment.status')
                ->with('error', '❌ Fixed RM10 payment failed or cancelled.');
        }
    }

    public function receipt($id)
    {
        $listing = Listing::findOrFail($id);

        if (!$listing->is_paid) {
            abort(403, 'Receipt not available.');
        }

        return response()->file(storage_path("app/receipts/{$listing->id}.pdf"));
    }

    public function fixedFeePayment()
{
    $member = Auth::user(); // ambil data login

    // RM10 dalam sen
    $amount = 10 * 100;

    // Optional: nama bill
    $billName = 'Viewing Fee - RM10';

    // Call ToyyibPay API untuk create bill
    $response = Http::asForm()->post(config('toyyibpay.url').'/index.php/api/createBill', [
        'userSecretKey'     => config('toyyibpay.key'),
        'categoryCode'      => config('toyyibpay.category'), // gunakan category asal
        'billName'          => $billName,
        'billDescription'   => 'Fee to view bids',
        'billPriceSetting'  => 1,
        'billPayorInfo'     => 1,
        'billAmount'        => $amount,
        'billReturnUrl'     => route('payment.fixed.callback'), // buat route callback
        'billCallbackUrl'   => route('payment.callback'),
        'billExternalReferenceNo' => 'fixed-fee-' . $member->id,
        'billTo'            => $member->name,
        'billEmail'         => $member->email,
        'billPhone'         => $member->phone,
        'billExpiryDate'    => now()->addDays(3)->format('Y-m-d'),
        'billExpiryDays'    => 3,
        'billPaymentChannel'=> 2,
        'billChargeToCustomer' => 1
    ]);

    $result = $response->json();
    Log::info('ToyyibPay Fixed Fee Response', $result);

    if (!empty($result[0]['BillCode'])) {
        $billCode = $result[0]['BillCode'];
        session(['toyyibpay_fee_billcode' => $billCode]);

        return redirect()->away(config('toyyibpay.url')."/$billCode");
    }

    return back()->with('error', 'Failed to create fixed fee payment. Response: ' . json_encode($result));
}

}
