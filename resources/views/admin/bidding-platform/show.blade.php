@extends('layouts.admin.app')

@section('title', 'Detailed Bidding Information')
@section('page-title', 'Detailed Bidding Information')

@section('styles')
<style>
    /* CSS tersuai untuk warna kelabu gelap */
    .bg-dark-grey {
        background-color: #212529 !important; /* Warna kelabu gelap */
        color: #fff;
    }

    /* CSS tambahan untuk header rasmi */
    .official-header {
        background: #212529 !important;
        color: #fff;
        padding: 1.5rem;
        border-radius: 0.5rem;
    }
    
    .breadcrumb a,
    .breadcrumb-item.active {
        color: #fff !important;
    }

    .card-header.bg-info {
        background-color: #212529 !important;
    }
</style>
@endsection

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
            {{-- Check if bidding exists and status is not 'COMPLETED' before showing delete button --}}
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

        {{-- Main Content Section --}}
        <div class="row">
            {{-- Bidding Item Information Card --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-black text-white">
                        <h4 class="mb-0">Bidding Item Information</h4>
                    </div>
                    <div class="card-body">
                        <ul class="info-list">
                            <li><span class="label">Bidding Item:</span> <span class="value">{{ $bidding->item }}</span>
                            </li>
                            <li><span class="label">Description:</span> <span class="value">{{ $bidding->info }}</span>
                            </li>
                            <li><span class="label">Starting Price:</span> <span class="value">RM
                                        {{ number_format($bidding->price, 2) }}</span></li>
                            <li><span class="label">Start Date:</span> <span
                                        class="value">{{ \Carbon\Carbon::parse($bidding->created_at)->format('d M Y, H:i:s') }}</span>
                            </li>
                            <li><span class="label">End Date:</span> <span
                                        class="value">{{ \Carbon\Carbon::parse($bidding->end_time)->format('d M Y, H:i:s') }}</span>
                            </li>
                            <li><span class="label">Total Bidders:</span> <span
                                        class="value">{{ $bidding->bids->count() }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Bidding Status and High Bid Card --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-black text-white">
                        <h4 class="mb-0">Bidding Status</h4>
                    </div>
                    <div class="card-body system-info">
                        <div class="system-item">
                            <span class="label">Bidding Status:</span>
                            <span class="value">
                                @if (\Carbon\Carbon::parse($bidding->end_time)->isFuture())
                                    <span class="badge bg-success">Ongoing</span>
                                @else
                                    <span class="badge bg-danger">Ended</span>
                                @endif
                            </span>
                        </div>
                        <div class="system-item">
                            <span class="label">Highest Bid:</span>
                            <span class="value">RM
                                {{ number_format($bidding->bids->max('bid_price') ?? $bidding->price, 2) }}</span>
                        </div>
                        <div class="system-item">
                            <span class="label">Highest Bidder:</span>
                            <span class="value">
                                @if ($bidding->status === 'COMPLETED')
                                    {{ $winner->name ?? 'N/A' }}
                                @else
                                    @php
                                        $highestBid = $bidding->bids->sortByDesc('bid_price')->first();
                                    @endphp
                                    {{-- Mengubah dari $highestBid->user kepada $highestBid->member --}}
                                    {{ $highestBid && $highestBid->member ? $highestBid->member->name : 'No bidders yet' }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section C: Display Information from 'bids' table --}}
            @if ($bidding->bids->count() > 0)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                    <div class="card-header bg-black text-white">
                            <h4 class="mb-0">List of Bidders</h4>
                        </div>
                        <div class="card-body">
                            <ul class="info-list">
                                @foreach($bidding->bids->sortByDesc('bid_price') as $bid)
                                    <li>
                                        <span class="label">Bidder Name:</span>
                                        {{-- Mengubah dari $bid->user kepada $bid->member --}}
                                        <span class="value">{{ $bid->member ? $bid->member->name : 'N/A' }}</span>
                                        <span class="label" style="margin-left: 20px;">Bid Amount:</span>
                                        <span class="value">RM {{ number_format($bid->bid_price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Footer Info --}}
            <div class="col-12">
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