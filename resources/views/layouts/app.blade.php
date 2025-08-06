<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Bidding System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS dari Vite --}}
    @vite('resources/css/app.css')

    {{-- Tailwind CDN (jika guna di luar Vite) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Scrollbar sembunyi */
        .hide-scrollbar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .hide-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none;    /* Firefox */
        }
    </style>
</head>
<body class="flex min-h-screen bg-gray-100 text-[#4B3621]">

    {{-- Sidebar ikut role --}}
    @if (session('active_role') === 'tender')
        @include('layouts.sidebar-tender')
    @else
        @include('layouts.sidebar')
    @endif

    {{-- Main content --}}
    <div class="main-content hide-scrollbar w-full overflow-y-auto">
        @yield('content')
    </div>

</body>
</html>
