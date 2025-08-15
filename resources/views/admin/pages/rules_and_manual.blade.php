@extends('layouts.admin.app')

@section('page-title', 'RULES & USER MANUAL')

@section('content')
    <div class="container py-4">
        <div class="border bg-white rounded p-4 shadow-sm">
            <h4 class="mb-3 fw-bold text-dark">eBidding System Rules</h4>
            <ol class="mb-4 ps-3">
                <li class="mb-2">Only registered users are allowed to participate in the bidding process.</li>
                <li class="mb-2">Each bid is final. No withdrawals are permitted after submission.</li>
                <li class="mb-2">Users must ensure their account has a sufficient balance before placing a bid.</li>
                <li class="mb-2">Misleading or fake bids will be immediately canceled.</li>
                <li class="mb-2">The administrator reserves the right to cancel any bid for a reasonable cause.</li>
            </ol>

            <hr>

            <h4 class="mt-4 mb-3 fw-bold text-dark">User Manual</h4>
            <ol class="ps-3">
                <li class="mb-2"><strong>Log In:</strong> Enter your email and password on the system's login page.</li>
                <li class="mb-2"><strong>Access Bids:</strong> Click the “Bidding Platform” menu to view active bids.</li>
                <li class="mb-2"><strong>Submit a Bid:</strong> Select a bid and enter your bid amount.</li>
                <li class="mb-2"><strong>Review Bids:</strong> View your bidding history through the “Bidding History”
                    menu.</li>
                <li class="mb-2"><strong>Update Profile:</strong> Change your personal information and profile picture on
                    the “Profile” page.</li>
            </ol>
        </div>
    </div>
@endsection
