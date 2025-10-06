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
    protected $baseUrl;

    public function __construct()
    {
        // Guna env untuk toggle sandbox/live
        $this->baseUrl = rtrim(config('toyyibpay.url', 'https://toyyibpay.com'), '/');
    }

    /**
     * Create a ToyyibPay payment bill for bidding
     */
    public function create($listingId)
    {
        $listing = Listing::findOrFail($listingId);

        $userBid = Bid::where('listing_id', $listingId)
            ->where('member_id', Auth::id())
            ->firstOrFail();

        $member = Member::findOrFail(Auth::id());

        $billName = Str::limit('Payment for ' . $listing->item, 30, '');

        // Call ToyyibPay API
        $response = Http::asForm()->post($this->baseUrl . '/index.php/api/createBill', [
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
            session(['toyyibpay_billcode' => $billCode]);

            return redirect()->away("{$this->baseUrl}/{$billCode}");
        }

        return back()->with('error', 'Failed to create payment bill. Response: ' . json_encode($result));
    }

    /**
     * Create a fixed RM10 payment (Viewing Fee)
     */
    public function fixedFeePayment()
    {
        $member = Auth::user();
        $amount = 10 * 100;
        $billName = 'Viewing Fee - RM10';

        // Call ToyyibPay API
        $response = Http::asForm()->post($this->baseUrl . '/index.php/api/createBill', [
            'userSecretKey'     => config('toyyibpay.key'),
            'categoryCode'      => config('toyyibpay.fixed_category', config('toyyibpay.category')),
            'billName'          => $billName,
            'billDescription'   => 'Fee to view bids',
            'billPriceSetting'  => 1,
            'billPayorInfo'     => 1,
            'billAmount'        => $amount,
            'billReturnUrl'     => route('payment.fixed.callback'),
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

            return redirect()->away("{$this->baseUrl}/{$billCode}");
        }

        return back()->with('error', 'Failed to create fixed fee payment. Response: ' . json_encode($result));
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
     * Callback dari ToyyibPay (server-to-server)
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
     * Redirect selepas bayar bid payment
     */
    public function redirectAfterPayment(Request $request, $bidId)
    {
        $statusId = $request->get('status_id');
        $billCode = $request->get('billcode') ?? session('toyyibpay_billcode');

        $bid = Bid::find($bidId);
        $listingId = $bid ? $bid->listing_id : null;

        if ($statusId == 1 && $bid) {
            $receiptUrl = "{$this->baseUrl}/{$billCode}";

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
     * Redirect selepas bayar fixed RM10
     */
    public function fixedFeeCallback(Request $request)
    {
        $statusId = $request->get('status_id');
        $billCode = $request->get('billcode') ?? session('toyyibpay_fee_billcode');

        if ($statusId == 1) {
            return redirect()->route('payment.status')
                ->with('success', '✅ Fixed RM10 payment successful!');
        } else {
            return redirect()->route('payment.status')
                ->with('error', '❌ Fixed RM10 payment failed or cancelled.');
        }
    }

    /**
     * Papar resit dalam bentuk PDF (jika telah dibayar)
     */
    public function receipt($id)
    {
        $listing = Listing::findOrFail($id);

        if (!$listing->is_paid) {
            abort(403, 'Receipt not available.');
        }

        return response()->file(storage_path("app/receipts/{$listing->id}.pdf"));
    }
}
