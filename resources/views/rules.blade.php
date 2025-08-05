@extends('layouts.app')

@push('styles')
<style>
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .bounce-in {
        animation: bounceIn 0.6s ease-out forwards;
    }
    @keyframes bounceIn {
        0% { transform: scale(0.95); opacity: 0; }
        60% { transform: scale(1.02); opacity: 1; }
        100% { transform: scale(1); }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 space-y-16 fade-in-up">

    <div class="text-center">
        <h1 class="text-4xl font-bold text-yellow-600">Bidding Process</h1>
        <h2 class="text-lg text-gray-500 mt-2">Step-by-step interactive guide</h2>
    </div>

    {{-- 01. Linear Process Flow --}}
    <section class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-800">01. Linear Process Flow</h3>
        <div class="flex flex-wrap gap-6">
            @php
                $steps1 = [
                    ['icon' => '1', 'title' => 'Member Registration', 'desc' => 'Submit personal details', 'active' => true],
                    ['icon' => '2', 'title' => 'Member Login', 'desc' => 'Email and password', 'active' => true],
                    ['icon' => '3', 'title' => 'Email Verification', 'desc' => 'Verify through profile'],
                    ['icon' => '4', 'title' => 'Choose Product', 'desc' => 'Select gold/silver items']
                ];
            @endphp
            @foreach($steps1 as $step)
                <div class="w-full sm:w-48 p-4 rounded-lg border text-center shadow-md {{ $step['active'] ?? false ? 'bg-yellow-50 border-yellow-300' : 'bg-white' }} bounce-in">
                    <div class="text-2xl font-bold text-yellow-600">{{ $step['icon'] }}</div>
                    <div class="mt-2 font-semibold">{{ $step['title'] }}</div>
                    <div class="text-sm text-gray-500">{{ $step['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 02. Checkbox Selection --}}
    <section class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-800">02. Checkbox Selection</h3>
        <div class="space-y-3">
            @php
                $checkboxes = [
                    ['label' => 'Member Registration', 'checked' => true],
                    ['label' => 'Member Login', 'checked' => true],
                    ['label' => 'Email Verification', 'checked' => false],
                    ['label' => 'Choose Product', 'checked' => false],
                    ['label' => 'Enter Bid Amount', 'checked' => false],
                    ['label' => 'Place Bid', 'checked' => false],
                ];
            @endphp
            @foreach($checkboxes as $box)
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 border rounded-full flex items-center justify-center {{ $box['checked'] ? 'bg-green-500 text-white' : 'text-gray-400' }}">
                        {{ $box['checked'] ? '✓' : '◯' }}
                    </div>
                    <div class="text-sm font-medium text-gray-700">{{ $box['label'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 03. Numbered Progress Steps --}}
    <section class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-800">03. Numbered Progress Steps</h3>
        <div class="grid sm:grid-cols-3 gap-6">
            @php
                $progress = [
                    ['num' => '✓', 'text' => 'Registration', 'desc' => 'Complete', 'status' => 'completed'],
                    ['num' => '✓', 'text' => 'Login', 'desc' => 'Complete', 'status' => 'completed'],
                    ['num' => '3', 'text' => 'Verification', 'desc' => 'Pending'],
                    ['num' => '4', 'text' => 'Bidding', 'desc' => 'Pending'],
                    ['num' => '5', 'text' => 'Payment', 'desc' => 'Pending'],
                ];
            @endphp
            @foreach($progress as $step)
                <div class="p-4 rounded-lg border shadow-sm text-center {{ $step['status'] ?? '' === 'completed' ? 'bg-green-50 border-green-300' : 'bg-white' }}">
                    <div class="text-xl font-bold text-yellow-600">{{ $step['num'] }}</div>
                    <div class="mt-2 font-semibold">{{ $step['text'] }}</div>
                    <div class="text-sm text-gray-500">{{ $step['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 04. Icon Card Grid --}}
    <section class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-800">04. Icon Card Grid</h3>
        <div class="grid md:grid-cols-3 gap-6">
            @php
                $icons = [
                    ['icon' => '👤', 'title' => 'Member Registration', 'desc' => 'Users must register an account by submitting accurate personal details'],
                    ['icon' => '🔐', 'title' => 'Member Login', 'desc' => 'Once registered, users can log in using their email and password'],
                    ['icon' => '✉️', 'title' => 'Email Verification', 'desc' => 'After logging in, verify email through profile settings'],
                    ['icon' => '🏆', 'title' => 'Choose Product to Bid', 'desc' => 'Select available gold or silver items'],
                    ['icon' => '💰', 'title' => 'Enter Bid Amount', 'desc' => 'Enter the bid amount, follow platform rules'],
                    ['icon' => '🎯', 'title' => 'Place Bid', 'desc' => 'Click "Place Bid" to submit your offer'],
                ];
            @endphp
            @foreach($icons as $item)
                <div class="p-4 rounded-lg border shadow hover:shadow-md transition duration-200 bg-white text-center">
                    <div class="text-3xl">{{ $item['icon'] }}</div>
                    <div class="mt-2 font-semibold">{{ $item['title'] }}</div>
                    <div class="text-sm text-gray-500">{{ $item['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 05. Timeline Process --}}
    <section class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-800">05. Complete Timeline Process</h3>
        <div class="space-y-4">
            @php
                $timeline = [
                    ['step' => 1, 'title' => 'Member Registration', 'desc' => 'Users must register...', 'status' => 'Completed'],
                    ['step' => 2, 'title' => 'Member Login', 'desc' => 'Once registered...', 'status' => 'Completed'],
                    ['step' => 3, 'title' => 'Email Verification', 'desc' => 'Verify through profile...', 'status' => 'In Progress'],
                    ['step' => 4, 'title' => 'Choose Product to Bid', 'desc' => 'Select available items...', 'status' => 'Pending'],
                    ['step' => 5, 'title' => 'Enter Bid Amount', 'desc' => 'Enter amount following rules...', 'status' => 'Pending'],
                    ['step' => 6, 'title' => 'Place Bid', 'desc' => 'Submit your offer...', 'status' => 'Pending'],
                    ['step' => 7, 'title' => 'View Bid Status', 'desc' => 'Check bids via status page...', 'status' => 'Pending'],
                    ['step' => 8, 'title' => 'Bid Outcome', 'desc' => 'Check results and next steps...', 'status' => 'Pending'],
                    ['step' => 9, 'title' => 'Payment Process', 'desc' => 'Submit shipping info...', 'status' => 'Pending'],
                    ['step' => 10, 'title' => 'Item in Tenders Account', 'desc' => 'Recorded upon success...', 'status' => 'Pending'],
                ];
            @endphp
            @foreach($timeline as $event)
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-yellow-600 text-white flex items-center justify-center">{{ $event['step'] }}</div>
                    <div>
                        <div class="font-semibold">{{ $event['title'] }}</div>
                        <div class="text-sm text-gray-500">{{ $event['desc'] }}</div>
                        <div class="text-xs mt-1 text-{{ $event['status'] === 'Completed' ? 'green' : ($event['status'] === 'In Progress' ? 'yellow' : 'gray') }}-600">{{ $event['status'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>

<script>
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
</script>
@endsection
