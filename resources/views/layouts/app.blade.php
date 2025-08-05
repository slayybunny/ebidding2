<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Bidding System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <style>
        /* Hide scrollbar but allow scroll */
        .hide-scrollbar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .hide-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-gray-100 text-[#4B3621]">

    {{-- Sidebar ikut mode --}}
    @if (session('active_role') === 'tender')
        @include('layouts.sidebar-tender')
    @else
        @include('layouts.sidebar')
    @endif

    {{-- Main Content --}}
    <div class="flex-1 p-6 overflow-y-auto hide-scrollbar">
        @yield('content')
    </div>

</body>
</html>
