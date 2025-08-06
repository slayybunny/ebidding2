@extends('layouts.admin.app')

@section('page-title', 'Resit Pembayaran')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Resit Pembayaran</h5>
    </div>
    <div class="card-body">
      <table class="table table-borderless">
        <tr>
          <th scope="row">ID Pembayaran:</th>
          <td>{{ $payment['id'] }}</td>
        </tr>
        <tr>
          <th scope="row">Nama Pembayar:</th>
          <td>{{ $payment['name'] }}</td>
        </tr>
        <tr>
          <th scope="row">Kod Transaksi:</th>
          <td>{{ $payment['transaction_code'] }}</td>
        </tr>
        <tr>
          <th scope="row">Jumlah Bayaran:</th>
          <td>RM{{ number_format($payment['amount'], 2) }}</td>
        </tr>
        <tr>
          <th scope="row">Kaedah Pembayaran:</th>
          <td>{{ $payment['method'] }}</td>
        </tr>
        <tr>
          <th scope="row">Tarikh & Masa:</th>
          <td>{{ \Carbon\Carbon::parse($payment['date'])->format('d/m/Y h:i A') }}</td>
        </tr>
        <tr>
          <th scope="row">Status:</th>
          <td>
            @if($payment['status'] === 'success')
              <span class="badge bg-success">Berjaya</span>
            @else
              <span class="badge bg-danger">Gagal</span>
            @endif
          </td>
        </tr>
      </table>
      <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
  </div>
</div>
@endsection
