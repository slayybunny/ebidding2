<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportingController extends Controller
{
    /**
     * Tunjukkan laporan keuntungan dengan data bulanan.
     *
     * @return \Illuminate\View\View
     */
    public function showProfitForm(Request $request)
    {
        // Tetapkan bulan dan tahun semasa sebagai default, atau ambil dari request
        $selectedMonthYear = $request->input('month_year', now()->format('Y-m'));
        $selectedPercentage = (int) $request->input('percentage', 10); // Default kepada 10%

        // Gunakan nilai dummy untuk jumlah kutipan SGCC untuk setiap bulan
        $dummyData = [
            '2025-01' => 25000.00,
            '2025-02' => 31000.00,
            '2025-03' => 28500.00,
            '2025-04' => 35000.00,
            '2025-05' => 41000.00,
            '2025-06' => 38500.00,
            '2025-07' => 45000.00,
            '2025-08' => 42500.00,
            '2025-09' => 48000.00,
            '2025-10' => 50000.00,
            '2025-11' => 47500.00,
            '2025-12' => 55000.00,
        ];
        
        $totalKutipanSGCC = $dummyData[$selectedMonthYear] ?? 0;

        // Mengira keuntungan untuk KBSE berdasarkan peratusan yang dipilih
        $profitForKBSE = ($totalKutipanSGCC * $selectedPercentage) / 100;

        // Dapatkan senarai bulan untuk dropdown
        $months = [];
        foreach ($dummyData as $key => $value) {
            $date = Carbon::parse($key . '-01');
            $months[] = [
                'value' => $date->format('Y-m'),
                'label' => $date->translatedFormat('F Y'),
            ];
        }

        // Hantar semua data ke view
        return view('admin.reports.profit_report', [
            'kutipan_sgcc' => $totalKutipanSGCC,
            'profit_for_kbse' => $profitForKBSE,
            'months' => $months,
            'selectedMonthYear' => Carbon::parse($selectedMonthYear . '-01')->translatedFormat('F Y'),
            'selectedPercentage' => $selectedPercentage,
        ]);
    }
}