@extends('layouts.admin.app')

@section('title', 'Detailed Bidding Information')
@section('page-title', 'Detailed Bidding Information')

@section('content')
    <div class="container-fluid">
        {{-- Top Header Section --}}
        <div class="official-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="header-content">
                        <h1 class="page-title mb-1">BIDDING MANAGEMENT SYSTEM</h1>
                        <div class="subtitle">
                            <span class="value">Malaysia Digital Bidding Platform</span>
                        </div>
                        <nav aria-label="breadcrumb" class="mt-2">
                            <ol class="breadcrumb custom-breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.bidding.index') }}">Homepage</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.bidding.index') }}">Bidding List</a>
                                </li>
                                <li class="breadcrumb-item active">Detailed Information</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="header-stats">
                        <div class="stat-item">
                            <span class="stat-label">System Date:</span>
                            <span class="stat-value">{{ date('d/m/Y') }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Time:</span>
                            <span class="stat-value">{{ date('H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Back and Action Buttons --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.bidding.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Bidding List
            </a>
            {{-- Check if bidding exists and status is not 'COMPLETED' before showing edit/delete buttons --}}
            @if (isset($bidding) && $bidding->status !== 'COMPLETED')
                <div class="d-flex">
                    <button type="button" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>
                        Delete Bidding
                    </button>
                </div>
            @endif
        </div>

        {{-- Code for Bidding Status --}}
        @php
            $bidding = $bidding ?? null;
            $statusClass = '';
            $statusText = '';
            if ($bidding) {
                switch ($bidding->status) {
                    case 'PENDING':
                        $statusClass = 'status-pending';
                        $statusText = 'PENDING';
                        break;
                    case 'ONGOING':
                        $statusClass = 'status-ongoing';
                        $statusText = 'ONGOING';
                        break;
                    case 'COMPLETED':
                        $statusClass = 'status-ended';
                        $statusText = 'COMPLETED';
                        break;
                    default:
                        $statusClass = 'status-ended';
                        $statusText = 'COMPLETED';
                        break;
                }
            }
        @endphp

        <div class="row">
            <div class="col-12">
                {{-- Section A: Product Information --}}
                <div class="official-section mb-4">
                    <div class="section-header">
                        <h3 class="section-title">A. PRODUCT INFORMATION</h3>
                    </div>
                    <div class="section-content p-4">
                        <div class="row">
                            {{-- Add item image here (fetched from database) --}}
                            @if (isset($bidding->image_url) && !empty($bidding->image_url))
                                <div class="col-md-4 mb-3">
                                    <div class="image-container">
                                        <img src="{{ asset($bidding->image_url) }}" alt="Bidding Item Image"
                                            class="img-fluid item-image">
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-8">
                                <div class="row">
                                    {{-- Only show this row if PRODUCT NAME exists (fetched from database) --}}
                                    @if (isset($bidding->item) && !empty($bidding->item))
                                        <div class="col-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label-sm fw-bold">PRODUCT NAME</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static fw-bold">{{ $bidding->item }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Only show this row if NET WEIGHT exists (fetched from database) --}}
                                    @if (isset($bidding->net_weight) && !empty($bidding->net_weight))
                                        <div class="col-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label-sm fw-bold">NET WEIGHT</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">{{ $bidding->net_weight }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Only show this row if PURITY LEVEL exists (fetched from database) --}}
                                    @if (isset($bidding->purity_level) && !empty($bidding->purity_level))
                                        <div class="col-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label-sm fw-bold">PURITY LEVEL</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">{{ $bidding->purity_level }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Only show this row if CATEGORY exists (fetched from database) --}}
                                    @if (isset($bidding->category) && !empty($bidding->category))
                                        <div class="col-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label-sm fw-bold">CATEGORY</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">{{ $bidding->category }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section B: Bidding Information --}}
                <div class="official-section mb-4">
                    <div class="section-header">
                        <h3 class="section-title">B. BIDDING INFORMATION</h3>
                    </div>
                    <div class="section-content p-4">
                        <div class="row">
                            {{-- Only show this row if STARTING PRICE exists and is more than 0 (fetched from database) --}}
                            @if (isset($bidding->starting_price) && $bidding->starting_price > 0)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">STARTING PRICE</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">RM
                                                {{ number_format($bidding->starting_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Highest bid only displayed if status is COMPLETED --}}
                            @if ($bidding->status === 'COMPLETED' && isset($bidding->highest_bid) && $bidding->highest_bid > 0)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">HIGHEST BID</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">RM {{ number_format($bidding->highest_bid, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Only show this row if START DATE exists (fetched from database) --}}
                            @if (isset($bidding->start_date) && !empty($bidding->start_date))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">START DATE</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                {{ $bidding->start_date->format('d F Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Only show this row if TOTAL BIDS exists (fetched from database) --}}
                            @if (isset($bidding->total_bids) && $bidding->total_bids >= 0)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">TOTAL BIDS</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">{{ $bidding->total_bids }} bids</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Only show this row if END DATE exists (fetched from database) --}}
                            @if (isset($bidding->end_date) && !empty($bidding->end_date))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">END DATE</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                {{ $bidding->end_date->format('d F Y, h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Display the number of bidders (Number of Bidders) --}}
                            @if (isset($bidding->number_of_bidders) && $bidding->number_of_bidders >= 0)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">NUMBER OF BIDDERS</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">{{ $bidding->number_of_bidders }} people</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Only show this row if STATUS exists (fetched from database) --}}
                            @if (isset($bidding->status) && !empty($bidding->status))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">STATUS</label>
                                        <div class="col-sm-8">
                                            <div class="status-badge {{ $statusClass }}">
                                                <span>{{ $statusText }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Only show this row if PERCENTAGE INCREASE exists and is more than 0 (fetched from database) --}}
                            @if (isset($bidding->percentage_increase) && $bidding->percentage_increase > 0 && $bidding->status === 'COMPLETED')
                                <div class="col-md-6 mb-3">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label-sm fw-bold">PERCENTAGE INCREASE</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
                                                +{{ number_format($bidding->percentage_increase, 2) }}%</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Section C: Display Information by Status --}}
                @if (isset($bidding->status) && $bidding->status === 'COMPLETED' && isset($winner))
                    {{-- Winner Information (Only for completed bids) --}}
                    <div class="official-section mb-4 winner-section">
                        <div class="section-header">
                            <h3 class="section-title">C. WINNER INFORMATION</h3>
                        </div>
                        <div class="section-content p-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        {{-- Only show this row if WINNER NAME exists --}}
                                        @if (isset($winner->name) && !empty($winner->name))
                                            <div class="col-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label-sm fw-bold">WINNER NAME</label>
                                                    <div class="col-sm-8">
                                                        <p class="form-control-static fw-bold">{{ $winner->name }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- Only show this row if USER ID exists --}}
                                        @if (isset($winner->user_id) && !empty($winner->user_id))
                                            <div class="col-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label-sm fw-bold">USER ID</label>
                                                    <div class="col-sm-8">
                                                        <p class="form-control-static">{{ $winner->user_id }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- Only show this row if FINAL BID exists and is more than 0 --}}
                                        @if (isset($winner->final_bid) && $winner->final_bid > 0)
                                            <div class="col-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label-sm fw-bold">FINAL BID</label>
                                                    <div class="col-sm-8">
                                                        <p class="form-control-static fw-bold text-success">
                                                            RM {{ number_format($winner->final_bid, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- Only show this row if BID TIME exists --}}
                                        @if (isset($winner->bid_time) && !empty($winner->bid_time))
                                            <div class="col-12 mb-3">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label-sm fw-bold">BID TIME</label>
                                                    <div class="col-sm-8">
                                                        <p class="form-control-static">
                                                            {{ $winner->bid_time->format('d F Y, h:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="winner-stamp">
                                        WINNER<br>OF BIDDING
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif (isset($bidding->status) && $bidding->status === 'ONGOING' && isset($currentBids) && $currentBids->isNotEmpty())
                    {{-- Current Bidders List (Only for ongoing bids) --}}
                    <div class="official-section mb-4 current-bids-section">
                        <div class="section-header">
                            <h3 class="section-title">C. CURRENT BIDDING INFORMATION</h3>
                        </div>
                        <div class="section-content p-4">
                            <div class="table-responsive">
                                <table class="table table-government-mini table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>USER NAME</th>
                                            <th>USER ID</th>
                                            <th>BID AMOUNT</th>
                                            <th>BID TIME</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentBids as $index => $bid)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $bid->name }}</td>
                                                <td>{{ $bid->user_id }}</td>
                                                <td>RM {{ number_format($bid->amount, 2) }}</td>
                                                <td>{{ $bid->bid_time ? $bid->bid_time->format('d/m/Y H:i:s') : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Footer Info --}}
                <div class="footer-info mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <h6 class="info-title">IMPORTANT NOTE:</h6>
                                <ul class="info-list">
                                    <li>All displayed times are based on Malaysia Time (GMT +8)</li>
                                    <li>Bidding status is updated automatically according to the system time</li>
                                    <li>For any inquiries, please contact the IT Unit</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <h6 class="info-title">SYSTEM INFORMATION:</h6>
                                <div class="system-info">
                                    <div class="system-item">
                                        <span class="label">System Version:</span>
                                        <span class="value">v2.1.0</span>
                                    </div>
                                    <div class="system-item">
                                        <span class="label">Last Updated:</span>
                                        <span class="value">{{ date('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Bidding Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Bidding</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this bidding? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    {{-- Ensure the $bidding variable exists before calling id --}}
                    @if (isset($bidding) && $bidding->id)
                        <form action="{{ route('admin.bidding.destroy', $bidding->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f5f5f5;
        }

        .official-header {
            background: linear-gradient(135deg, #CD853F 0%, #DAA520 100%);
            color: white;
            padding: 25px;
            border-radius: 0;
            margin: -15px -15px 20px -15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .subtitle .value {
            font-weight: bold;
            margin-left: 10px;
        }

        .custom-breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .custom-breadcrumb .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .custom-breadcrumb .breadcrumb-item.active {
            color: white;
        }

        .header-stats {
            text-align: right;
        }

        .stat-item {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .stat-label {
            opacity: 0.8;
        }

        .stat-value {
            font-weight: bold;
            margin-left: 10px;
        }

        .official-section {
            background: white;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .section-header {
            background: #f8f9fa;
            border-bottom: 3px solid #CD853F;
            padding: 20px 25px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #CD853F;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-content {
            padding: 0;
        }

        .form-group {
            margin-bottom: 0.5rem;
        }

        .form-control-static {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 0.875rem;
            color: #495057;
        }

        .form-control-static.fw-bold {
            font-weight: bold;
            color: #212529;
        }

        .form-group label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
        }

        .status-ongoing {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .status-ended {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f1aeb5;
        }

        .image-container {
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f9f9f9;
            border-radius: 8px;
            max-width: 250px;
            margin: 0 auto;
        }

        .item-image {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 5px;
        }

        .winner-section .section-header {
            background: #fdf2e9;
            border-bottom-color: #CD853F;
        }

        .winner-stamp {
            border: 3px solid #CD853F;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #CD853F;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-info {
            margin-top: 30px;
        }

        .info-box {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .info-title {
            font-weight: bold;
            color: #CD853F;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            border-bottom: 2px solid #CD853F;
            padding-bottom: 5px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            padding: 5px 0;
            font-size: 13px;
            color: #495057;
            border-bottom: 1px dotted #dee2e6;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-list li:before {
            content: "→";
            color: #CD853F;
            margin-right: 8px;
            font-weight: bold;
        }

        .system-info {
            font-size: 13px;
        }

        .system-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dotted #dee2e6;
        }

        .system-item:last-child {
            border-bottom: none;
        }

        .system-item .label {
            color: #6c757d;
        }

        .system-item .value {
            font-weight: bold;
            color: #495057;
        }

        /* Gaya jadual untuk senarai bidaan semasa */
        .table-government-mini th,
        .table-government-mini td {
            font-size: 13px;
            padding: 10px 12px;
            vertical-align: middle;
        }

        .table-government-mini thead th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #CD853F;
        }

        .table-government-mini tbody tr:hover {
            background-color: #e9ecef;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
            }

            .winner-stamp {
                width: 120px;
                height: 120px;
                font-size: 16px;
            }
        }
    </style>
@endsection
