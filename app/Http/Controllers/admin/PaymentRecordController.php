<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentRecordController extends Controller
{
    public function index()
    {
        // Dummy data
        $payments = [
            [
                'id' => 1,
                'payer' => 'SGCC Corporation',
                'transaction_id' => 'TXN0012456',
                'amount' => 5000.00,
                'paid_at' => '2025-07-20',
                'status' => 'Selesai',
            ],
            [
                'id' => 2,
                'payer' => 'Golden Ventures',
                'transaction_id' => 'TXN0012489',
                'amount' => 3200.00,
                'paid_at' => '2025-07-22',
                'status' => 'Menunggu',
            ],
        ];

        return view('admin.payments.index', compact('payments'));
    }
    
}
