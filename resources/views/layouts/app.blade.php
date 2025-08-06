<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Bidding System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-[#fafbfc] text-[#4B3621]">

    <div class="flex min-h-screen overflow-hidden">
        {{-- Sidebar ikut role --}}
        @if (session('active_role') === 'tender')
            @include('layouts.sidebar-tender')
        @else
            @include('layouts.sidebar')
        @endif

    </div>

</body>
</html>
