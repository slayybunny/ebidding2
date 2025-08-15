@extends('layouts.app')

@section('content')
<style>
    .gold-theme {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #fff8dc;
        min-height: 80vh;
        padding: 40px 20px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.6);
        font-family: 'Georgia', serif;
    }
    .gold-theme h1,
    .gold-theme h2 {
        color: #fff3b0;
        text-shadow: 1px 1px 3px #8b6d0d;
    }
    .gold-theme p {
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 15px;
        color: #fffde7;
        text-shadow: 0 0 5px #ab8320;
    }
    .gold-theme ul {
        list-style-type: disc;
        padding-left: 20px;
        color: #fffde7;
    }
    .gold-theme ul li {
        margin-bottom: 10px;
        text-shadow: 0 0 5px #ab8320;
    }
</style>

<div class="container mt-5">
    <div class="gold-theme mx-auto max-w-4xl">
        <h1 class="mb-4">Terms & Conditions for E-Bidding Bid Gold</h1>

        <p>Welcome to our exclusive e-bidding platform for Bid Gold. Please read these terms and conditions carefully before using our services.</p>

        <h2>1. Definitions</h2>
        <p><strong>E-Bidding:</strong> An electronic bidding process where users can place bids on items or services offered.</p>
        <p><strong>Bid Gold:</strong> A credit or token system used by users to place bids on this platform.</p>

        <h2>2. Registration & Account</h2>
        <ul>
            <li>Users must register and have a valid account to participate in e-bidding.</li>
            <li>Users are responsible for maintaining the confidentiality of their account and personal information.</li>
            <li>All activity conducted through the user account is the sole responsibility of the user.</li>
        </ul>

        <h2>3. Use of Bid Gold</h2>
        <ul>
            <li>Bid Gold is a credit that must be purchased or earned to place bids.</li>
            <li>Bid Gold is non-transferable and cannot be exchanged for cash.</li>
            <li>Each bid placed will consume a specified amount of Bid Gold.</li>
            <li>Bid Gold used is non-refundable except under circumstances authorized by us.</li>
        </ul>

        <h2>4. E-Bidding Process</h2>
        <ul>
            <li>Bids can be placed live during the designated bidding period on the platform.</li>
            <li>All bids are final and cannot be canceled once confirmed.</li>
            <li>The highest bidder at the close of the bidding period wins the item.</li>
            <li>In case of disputes, our decision is final and binding.</li>
        </ul>

        <h2>5. Payment & Settlement</h2>
        <ul>
            <li>The winning bidder must make payment for the winning bid amount within the specified timeframe.</li>
            <li>Failure to pay within the deadline may result in cancellation of the win and suspension of the account.</li>
        </ul>

        <h2>6. Liability & Disclaimer</h2>
        <p>We are not liable for any losses or damages resulting from the use of the e-bidding platform or Bid Gold credits.</p>

        <h2>7. Amendments</h2>
        <p>We reserve the right to amend these terms and conditions at any time without prior notice.</p>

        <p>By using the e-bidding platform and Bid Gold, you agree to abide by these terms and conditions.</p>
    </div>
</div>
@endsection
