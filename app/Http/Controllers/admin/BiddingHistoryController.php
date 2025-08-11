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
    
    // Atau jika anda menggunakan pagination
    // $loginLogs = LoginLog::with(['user', 'admin'])->paginate(10);
    
    return view('admin.bidding-history.index', compact('loginLogs'));
}

    /**
     * Remove the specified login log from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginLog $loginLog)
    {
        $loginLog->delete();

        // Redirect kembali dengan mesej kejayaan
        return redirect()->back()->with('success', 'Rekod log masuk berjaya dipadam.');
    }
}
