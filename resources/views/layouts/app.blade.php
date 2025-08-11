<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Bidding System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        main {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        main::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-[#fafbfc] text-[#4B3621]">

    <div class="flex min-h-screen w-full">
        {{-- Sidebar automatik ikut role --}}
        @if (session('active_role') === 'tender')
            @include('layouts.sidebar-tender')
        @else
            @include('layouts.sidebar')
        @endif

        {{-- Main content --}}
        <main class="flex-1 overflow-y-auto no-scrollbar">
            <div class="w-full px-4 py-10">
                @yield('content')
            </div>
        </main>
    </div>
@stack('scripts') 
</body>
</html>
