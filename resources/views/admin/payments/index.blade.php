@extends('layouts.admin.app')

@section('title', 'Payment Records')
@section('page-title', 'PAYMENT RECORDS')

@section('content')
<style>
  .badge-success {
    background-color: #10b981;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
  }

  .badge-failed {
    background-color: #ef4444;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
  }

  .badge-pending {
    background-color: #f59e0b;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
  }

  .btn-view {
    background-color: transparent;
    color: #2563eb;
    border: 1px solid #2563eb;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 14px;
  }

  .btn-view i {
    margin-right: 5px;
  }

  .table thead {
    background-color: #f8fafc;
  }

  .table td {
    vertical-align: middle;
  }
</style>

<div class="container mt-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="mb-4">Rekod Pembayaran</h5>

      <table class="table table-bordered align-middle text-center">
        <thead>
          <tr>
            <th>Bil</th>
            <th>Nama Pengguna</th>
            <th>Kod Transaksi</th>
            <th>Jumlah (RM)</th>
            <th>Kaedah Bayaran</th>
            <th>Tarikh</th>
            <th>Status</th>
            <th>Tindakan</th>
          </tr>
        </thead>
        <tbody>
          @php
              $payments = [
                  ['name' => 'Ali Bin Ahmad', 'transaction_code' => 'TXN00123', 'amount' => 550.00, 'method' => 'Online Banking', 'date' => '2025-05-23 10:23:00', 'status' => 'success'],
                  ['name' => 'Zarina Binti Omar', 'transaction_code' => 'TXN00124', 'amount' => 320.00, 'method' => 'Credit Card', 'date' => '2025-06-01 11:45:12', 'status' => 'pending'],
                  ['name' => 'Muthu Kumar', 'transaction_code' => 'TXN00125', 'amount' => 230.00, 'method' => 'Online Banking', 'date' => '2025-08-01 13:10:00', 'status' => 'failed'],
              ];
          @endphp

          @foreach($payments as $index => $payment)
            @php
              $badgeClass = match($payment['status']) {
                  'success' => 'badge-success',
                  'failed' => 'badge-failed',
                  'pending' => 'badge-pending',
                  default => 'badge-secondary'
              };
              $statusText = match($payment['status']) {
                  'success' => 'Success',
                  'failed' => 'Failed',
                  'pending' => 'Pending',
                  default => 'Tidak Diketahui'
              };
            @endphp

            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $payment['name'] }}</td>
              <td>{{ $payment['transaction_code'] }}</td>
              <td>{{ number_format($payment['amount'], 2) }}</td>
              <td>{{ $payment['method'] }}</td>
              <td>{{ \Carbon\Carbon::parse($payment['date'])->format('d/m/Y H:i') }}</td>
              <td>
                <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
              </td>
              <td>
                <a href="#" class="btn btn-view">
                  <i class="fas fa-receipt"></i> Lihat Resit
                </a>
              </td>
            </tr>
          @endforeach

          @if(count($payments) === 0)
            <tr>
              <td colspan="8" class="text-muted">Tiada rekod pembayaran dijumpai.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
