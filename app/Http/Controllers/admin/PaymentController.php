<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Memaparkan senarai rekod pembayaran.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua pembayaran dengan pagination.
        // Ini akan mengembalikan objek paginator, bukan array biasa.
        $payments = Payment::paginate(10);

        // Kira statistik ringkasan untuk kad maklumat.
        $totalAmount = Payment::where('status', 'berjaya')->sum('amount');
        $successCount = Payment::where('status', 'berjaya')->count();
        $pendingCount = Payment::where('status', 'tertangguh')->count();
        $failedCount = Payment::where('status', 'gagal')->count();

        // Hantar semua data ke view.
        return view('admin.payments.index', compact('payments', 'totalAmount', 'successCount', 'pendingCount', 'failedCount'));
    }
}
