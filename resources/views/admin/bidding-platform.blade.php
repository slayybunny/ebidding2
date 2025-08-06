@extends('layouts.admin.app')

@section('page-title', 'BIDDING PLATFORM')

@section('content')
@php
    use Carbon\Carbon;

    $now = Carbon::now();
    $biddings = [
        ['id' => 1, 'title' => 'Emas 999 10g', 'start_time' => '2025-07-17 10:00:00', 'end_time' => '2025-07-18 10:00:00'],
        ['id' => 2, 'title' => 'Emas 916 5g', 'start_time' => '2025-07-15 09:00:00', 'end_time' => '2025-07-16 09:00:00'],
        ['id' => 3, 'title' => 'Emas 999 1g (Special)', 'start_time' => '2025-07-17 12:00:00', 'end_time' => '2025-07-17 18:00:00'],
    ];
@endphp

<style>
  .btn-action {
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 20px;
    margin: 2px;
    text-decoration: none;
    display: inline-block;
  }

  .btn-action.info { background-color: #3b82f6; color: #fff; }
  .btn-action.warning { background-color: #facc15; color: #000; }
  .btn-action.danger { background-color: #ef4444; color: #fff; }

  .btn-action:disabled {
    background-color: #d1d5db;
    color: #6b7280;
  }

  .badge-status {
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 20px;
    display: inline-block;
    min-width: 80px;
    text-align: center;
  }

  .badge-success { background-color: #198754; color: #fff; }
  .badge-danger { background-color: #dc3545; color: #fff; }
  .badge-secondary { background-color: #6c757d; color: #fff; }

  .table {
    border-collapse: collapse;
    width: 100%;
    background-color: #f1f1f1; /* Light grey background */
    font-size: 14px;
  }

  .table th {
    background-color: #6c757d; /* Dark grey header */
    color: #fff;
    font-weight: 500;
    padding: 12px;
    border: 1px solid #dee2e6;
  }

  .table td {
    padding: 10px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
    background-color: #f9f9f9; /* Slightly lighter grey for rows */
  }

  .table tbody tr:hover {
    background-color: #e2e2e2; /* Hover effect grey */
  }

  .table thead th {
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
  }
  .table thead {
    background-color: grey !important;
}

</style>


<div class="container mt-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Senarai Bidaan</h5>
        <a href="{{ route('admin.bidding.create') }}" class="btn btn-primary btn-sm">+ Tambah Bidaan Baru</a>
      </div>

      <div class="table-responsive">
        <table class="table text-center align-middle">
          <thead>
            <tr>
              <th>Bil</th>
              <th>Tajuk</th>
              <th>Tarikh Mula</th>
              <th>Tarikh Tamat</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($biddings as $index => $bidding)
              @php
                  $start = Carbon::parse($bidding['start_time']);
                  $end = Carbon::parse($bidding['end_time']);
                  $isActive = $now->between($start, $end);
                  $isEnded = $now->gt($end);
              @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bidding['title'] }}</td>
                <td>{{ $start->format('d/m/Y H:i') }}</td>
                <td>{{ $end->format('d/m/Y H:i') }}</td>
                <td>
                  @if($isActive)
                      <span class="badge-status badge-success">Aktif</span>
                  @elseif($isEnded)
                      <span class="badge-status badge-danger">Tamat</span>
                  @else
                      <span class="badge-status badge-secondary">Belum Mula</span>
                  @endif
                </td>
                <td>
                  @if($isEnded)
                    <a href="{{ route('admin.bidding.show', $bidding['id']) }}" class="btn-action info">Lihat</a>
                    <a href="{{ route('admin.bidding.edit', $bidding['id']) }}" class="btn-action warning">Edit</a>
                    <button class="btn-action danger">Padam</button>
                  @else
                    <button class="btn-action info" disabled>Lihat</button>
                    <button class="btn-action warning" disabled>Edit</button>
                    <button class="btn-action danger" disabled>Padam</button>
                  @endif
                </td>
              </tr>
            @endforeach

            @if(count($biddings) === 0)
              <tr>
                <td colspan="6" class="text-muted">Tiada bidaan dijumpai.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
