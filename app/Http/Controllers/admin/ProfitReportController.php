<?php

// app/Http/Controllers/Admin/ProfitReportController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfitReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.profit'); // Blade di atas
    }
    public function exportPdf()
{
    // Dummy data (boleh tukar kepada data sebenar dari database)
    $report = [
        [
            'month' => 'July',
            'year' => 2025,
            'total_auctions' => 3,
            'total_profit' => 150.00,
            'commission' => 7.50,
        ],
        [
            'month' => 'August',
            'year' => 2025,
            'total_auctions' => 2,
            'total_profit' => 100.00,
            'commission' => 5.00,
        ],
    ];

    $pdf = Pdf::loadView('admin.reports.profit_pdf', ['report' => $report]);
    return $pdf->download('monthly_profit_report.pdf');
}
}

