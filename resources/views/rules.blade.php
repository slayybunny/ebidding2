@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #fffaf0;
        color: #4b3b22;
    }

    .container-terms {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .rules-card {
        background: #fffef9;
        padding: 30px 25px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(191, 160, 70, 0.15);
        margin-bottom: 25px;
        border-left: 5px solid #bfa046;
        transition: box-shadow 0.3s ease;
    }

    .rules-card:hover {
        box-shadow: 0 15px 35px rgba(191, 160, 70, 0.25);
    }

    .rules-card h2 {
        font-size: 1.4rem;
        margin-bottom: 10px;
        color: #4b3b22;
    }

    .rules-card ul {
        padding-left: 20px;
    }

    .rules-card ul li {
        margin-bottom: 8px;
        line-height: 1.6;
    }

    .icon {
        font-size: 1.8rem;
        margin-right: 10px;
        vertical-align: middle;
        color: #bfa046;
    }

    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
</style>

<div class="container-terms">
    <!-- Tajuk seperti Home -->
    <div class="text-center py-10">
        <h1 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-yellow-600 to-yellow-500 drop-shadow-lg tracking-wide leading-tight">
            🏆 Bidding Rules & Guidelines
        </h1>
        <p class="text-gray-600 mt-3 text-base md:text-lg italic">
            Please read carefully before participating in any bidding activity.
        </p>
    </div>
<br>
    <!-- Kad peraturan -->
    <div class="rules-card">
        <div class="card-header">
            <span class="icon">🛡️</span>
            <h2>Registration & Account Verification</h2>
        </div>
        <ul>
            <li>All users must register with complete and valid personal details.</li>
            <li>Users must log in using their registered email and password.</li>
            <li>Account activation via email confirmation is required before bidding.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">📦</span>
            <h2>Product Selection</h2>
        </div>
        <ul>
            <li>Users may only bid on products officially listed on the platform.</li>
            <li>Listed products may include gold, silver, or other items approved by the administrator.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">💼</span>
            <h2>Bidding Process</h2>
        </div>
        <ul>
            <li>Bids must be entered according to the specified format and guidelines.</li>
            <li>Click the “Place Bid” button to submit your offer.</li>
            <li>All submitted bids are final and cannot be revoked.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">📊</span>
            <h2>Bid Status</h2>
        </div>
        <ul>
            <li>Users may track their bid status via the bidding dashboard.</li>
            <li>Notifications will be sent regarding the outcome of each bid.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">💳</span>
            <h2>Payment & Ownership</h2>
        </div>
        <ul>
            <li>Successful bidders must complete the payment within the specified time.</li>
            <li>Accurate delivery information must be provided by the user.</li>
            <li>Ownership of the product is only valid after full payment confirmation.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">⚖️</span>
            <h2>User Conduct & Responsibility</h2>
        </div>
        <ul>
            <li>Any fraud, fake bidding, or system misuse will result in strict action, including account suspension.</li>
            <li>Users are solely responsible for all activity and bids placed via their account.</li>
        </ul>
    </div>

    <div class="rules-card">
        <div class="card-header">
            <span class="icon">📝</span>
            <h2>General Provisions</h2>
        </div>
        <ul>
            <li>The management reserves the right to modify these rules at any time without prior notice.</li>
            <li>By using this platform, users are deemed to have read, understood, and agreed to the stated rules.</li>
        </ul>
    </div>
</div>
@endsection
