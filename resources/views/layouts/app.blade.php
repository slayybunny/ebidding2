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

         html, body {
        overflow: hidden;
    }
    main {
        height: 100vh;
        overflow-y: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    main::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>
<body class="bg-gray-100 text-[#4B3621]">

    <div class="flex min-h-screen overflow-hidden">
        {{-- Sidebar ikut role --}}
        @if (session('active_role') === 'tender')
            @include('layouts.sidebar-tender')
        @else
            @include('layouts.sidebar')
        @endif

        <main class="flex-1 hide-scrollbar overflow-y-auto">
            <div class="flex justify-center px-4 py-10">
                <div class="w-full max-w-6xl">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

</body>
</html>
