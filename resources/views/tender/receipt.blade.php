<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SGCC Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 20px; }
        .receipt-container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border: 1px solid #ddd; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header img { height: 60px; }
        .header div { text-align: right; }
        .title { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table th { background: #f0f0f0; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 10px; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }

        /* Buttons at bottom */
        .button-container { margin-top: 20px; text-align: center; }
        .back-btn, .print-btn { display: inline-block; margin: 5px; padding: 8px 16px; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; cursor: pointer; }
        .back-btn { background: #6b7280; }
        .back-btn:hover { background: #4b5563; }
        .print-btn { background: #3b82f6; }
        .print-btn:hover { background: #2563eb; }

        /* Hide buttons when printing */
        @media print {
            .button-container { display: none !important; }
            body { background: #fff; padding: 0; }
            .receipt-container { border: none; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <img src="{{ asset('images/main.jpg') }}" alt="SGCC Logo">
            <div>
                <p>SGCC Co. Ltd</p>
                <p>123 Tender Street, Kuala Lumpur, Malaysia</p>
                <p>Phone: +60 12-3456789</p>
            </div>
        </div>

        <div class="title">Payment Receipt</div>
        <p><strong>Transaction ID:</strong> {{ $transaction->bid_id }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($transaction->bid_created_at)->format('d M Y H:i') }}</p>
        <p><strong>Winner:</strong> {{ $transaction->name }}</p>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Bid Price (RM)</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->item }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ number_format($transaction->bid_price, 2) }}</td>
                    <td>{{ $transaction->info ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">Total Paid: RM {{ number_format($transaction->bid_price, 2) }}</div>

        <div class="footer">
            Thank you for participating in SGCC auction.<br>
            This is a computer-generated receipt.
        </div>

        <!-- Buttons at bottom -->
        <div class="button-container">
            <a href="{{ route('winner.transactions') }}" class="back-btn">⬅ Back to Transactions</a>
            <button onclick="window.print()" class="print-btn">🖨 Print Receipt</button>
        </div>
    </div>
</body>
</html>
