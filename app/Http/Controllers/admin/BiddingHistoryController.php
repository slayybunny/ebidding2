<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\LoginLog;

class BiddingHistoryController extends Controller
{
    /**
     * Display a listing of the bidding history and login history for admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menggunakan eager loading untuk memuatkan relasi 'user' dan 'admin'
        // ini memastikan data pengguna tersedia untuk setiap rekod log
        $loginLogs = LoginLog::with(['user', 'admin'])->get();

        // Menggunakan eager loading untuk memuatkan relasi 'member' dan 'listing'
        // seperti yang didefinisikan dalam model Bid anda
        $biddingRecords = Bid::with(['member', 'listing'])->orderBy('created_at', 'desc')->get();

        // Kembalikan view dengan data login dan bidding yang telah diambil
        return view('admin.bidding-history.index', compact('loginLogs', 'biddingRecords'));
    }

    /**
     * Remove the specified login log from storage.
     *
     * @param  LoginLog  $loginLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginLog $loginLog)
    {
        $loginLog->delete();

        return redirect()->back()->with('success', 'Rekod log masuk berjaya dipadam.');
    }
}