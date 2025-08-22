@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-6 py-6">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center space-x-3">
        <span class="text-yellow-600">📊</span>
        <span>Monthly Profit Report - KBSE Technology</span>
    </h1>

    {{-- Month & Percentage Selection --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8 border border-gray-100">
        <form id="report-form" action="{{ route('admin.reports.profit.form') }}" method="GET" 
              class="flex flex-col md:flex-row items-center md:space-x-6 space-y-4 md:space-y-0">
            
            {{-- Select Month --}}
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <label for="month-select" class="text-gray-700 font-semibold whitespace-nowrap">📅 Select Month:</label>
                <select name="month_year" id="month-select" 
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 w-full md:w-48">
                    @foreach($months as $month)
                        <option value="{{ $month['value'] }}" {{ $month['value'] == Request::get('month_year', now()->format('Y-m')) ? 'selected' : '' }}>
                            {{ $month['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Select Percentage --}}
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <label for="percentage-select" class="text-gray-700 font-semibold whitespace-nowrap">💹 Select Percentage:</label>
                <select name="percentage" id="percentage-select" 
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 w-full md:w-40">
                    @foreach([10, 15, 20, 25, 30] as $percentage)
                        <option value="{{ $percentage }}" {{ $selectedPercentage == $percentage ? 'selected' : '' }}>
                            {{ $percentage }}%
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" 
                    class="bg-yellow-600 text-white px-6 py-2 rounded-lg shadow hover:bg-yellow-700 transition font-semibold">
                Show Report
            </button>
        </form>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- SGCC Total Collection --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-600 font-medium text-sm uppercase tracking-wide">SGCC Total Collection</h2>
                    <p class="text-3xl font-extrabold text-gray-900 mt-2">
                        RM {{ number_format((float) ($kutipan_sgcc ?? 0), 2) }}
                    </p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                    💰
                </div>
            </div>
        </div>

        {{-- Report Month --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-600 font-medium text-sm uppercase tracking-wide">Report Month</h2>
                    <p class="text-3xl font-extrabold text-gray-900 mt-2">
                        {{ $selectedMonthYear }}
                    </p>
                </div>
                <div class="bg-gray-200 text-gray-800 p-3 rounded-full">
                    📅
                </div>
            </div>
        </div>

        {{-- KBSE Profit --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-600 font-medium text-sm uppercase tracking-wide">
                        Profit for KBSE ({{ $selectedPercentage }}%)
                    </h2>
                    <p class="text-3xl font-extrabold text-green-600 mt-2">
                        RM {{ number_format((float) ($profit_for_kbse ?? 0), 2) }}
                    </p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    📈
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
