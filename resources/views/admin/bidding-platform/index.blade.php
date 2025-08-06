@extends('layouts.admin.app')

@section('title', 'Bidding Platform')
@section('page-title', 'BIDDING PLATFORM')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">Senarai Sesi Bidding</h5>

            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
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
                    @php
                        use Carbon\Carbon;
                        $now = Carbon::now(); // Waktu semasa sistem

                        $biddings = [
                            ['id' => 1, 'title' => 'Emas 999 10g', 'start_time' => '2025-08-02 10:00:00', 'end_time' => '2025-08-03 10:00:00'],
                            ['id' => 2, 'title' => 'Emas 916 5g', 'start_time' => '2025-07-15 09:00:00', 'end_time' => '2025-07-16 09:00:00'],
                            ['id' => 3, 'title' => 'Emas 999 1g (Special)', 'start_time' => '2025-08-01 12:00:00', 'end_time' => '2025-08-01 18:00:00'],
                        ];
                    @endphp

                    @forelse($biddings as $index => $bidding)
                        @php
                            $start = Carbon::parse($bidding['start_time']);
                            $end = Carbon::parse($bidding['end_time']);
                            $statusClass = '';
                            $statusText = '';

                            if ($now->lt($start)) {
                                $statusClass = 'bg-warning text-dark'; // oren
                                $statusText = 'Pending';
                            } elseif ($now->between($start, $end)) {
                                $statusClass = 'bg-success'; // hijau
                                $statusText = 'Ongoing';
                            } else {
                                $statusClass = 'bg-danger'; // merah
                                $statusText = 'Ended';
                            }
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bidding['title'] }}</td>
                            <td>{{ $start->format('d/m/Y H:i') }}</td>
                            <td>{{ $end->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $statusClass }} px-3 py-2">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bidding.show', $bidding['id']) }}" class="btn btn-sm btn-info">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tiada sesi bidding tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
