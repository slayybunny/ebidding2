<!--sidebar.blade.php-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGCC User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-gold {
            background: linear-gradient(135deg, #d4af37 0%, #b8860b 50%, #daa520 100%);
            position: relative;
        }

        .sidebar-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
        }

        .nav-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 4px;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.2) 100%);
            transition: width 0.3s ease;
            z-index: 1;
        }

        .nav-item:hover::before {
            width: 100%;
        }

        .nav-item:hover {
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        .nav-item:hover .nav-text {
            color: white !important;
        }

        .nav-item:hover .nav-icon {
            color: white !important;
        }

        .nav-item.active {
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4);
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0.3) 100%);
        }

        .nav-item.active .nav-text,
        .nav-item.active .nav-icon {
            color: white !important;
        }

        .nav-content {
            position: relative;
            z-index: 2;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
            color: white;
        }

        .search-input::placeholder {
            color: white !important;
            opacity: 0.7;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-top: 4px;
        }

        .submenu.open {
            max-height: 300px;
            opacity: 1;
            padding: 8px 0;
        }

        .submenu-item {
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 8px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .submenu-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(4px);
            color: white !important;
            text-decoration: none;
        }

        .icon-container {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(184, 134, 11, 0.3);
            margin-right: 12px;
        }

        .nav-item:hover .icon-container {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .chevron-icon {
            transition: transform 0.3s ease;
            margin-left: auto;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        .text-gold { color: #b8860b; }
        .text-gold-dark { color: #8b6914; }
        .border-gold { border-color: rgba(184, 134, 11, 0.4); }
        .text-white-custom { color: white; }

        .sidebar-container {
            transition: all 0.3s ease;
            width: 288px;
        }

        .sidebar-container.collapsed {
            width: 70px;
        }

        .sidebar-container.collapsed .nav-text,
        .sidebar-container.collapsed .search-container,
        .sidebar-container.collapsed .user-info,
        .sidebar-container.collapsed .submenu,
        .sidebar-container.collapsed .chevron-icon,
        .sidebar-container.collapsed .role-switch {
            display: none;
        }

        .sidebar-container.collapsed .nav-item {
            justify-content: center;
            padding: 12px 8px;
        }

        .sidebar-container.collapsed .nav-content {
            justify-content: center;
        }

        .sidebar-container.collapsed .icon-container {
            margin: 0;
        }

        .sidebar-container.collapsed .logout-container {
            padding: 8px;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: linear-gradient(135deg, #d4af37 0%, #b8860b 50%, #daa520 100%);
            border: none;
            border-radius: 6px;
            padding: 8px;
            color: white;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .hamburger-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        .sidebar-container:not(.collapsed) + .hamburger-btn {
            left: 308px;
        }

        .sidebar-container.collapsed + .hamburger-btn {
            left: 90px;
        }

        .tooltip {
            position: absolute;
            left: 55px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-container.collapsed .nav-item:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }

        .scrollbar-hidden {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }

        .main-content {
            margin-left: 288px;
            transition: margin-left 0.3s ease;
            padding: 20px;
            background: #f8fafc;
            min-height: 100vh;
        }

        .sidebar-container.collapsed + .main-content {
            margin-left: 70px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .sidebar-container {
                transform: translateX(-100%);
                position: fixed;
                z-index: 2000;
            }

            .sidebar-container.mobile-active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .hamburger-btn {
                left: 20px;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1500;
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        .top-navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
            padding: 20px 32px;
            position: fixed;
            top: 0;
            left: 288px;
            right: 0;
            z-index: 999;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: left 0.3s ease;
        }

        .sidebar-container.collapsed + .top-navbar {
            left: 70px;
        }

        @media (max-width: 768px) {
            .top-navbar {
                left: 0;
                padding: 16px 20px;
            }
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #b8860b, #cd853f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.2);
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(184, 134, 11, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar Overlay for mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()" id="sidebar-overlay"></div>


    <div class="sidebar-container h-screen sidebar-gold text-white flex flex-col fixed shadow-2xl" id="sidebar">
        <!-- User Info -->
        <div class="text-center px-6 py-4 border-b border-gold user-info">
            @auth
                <!-- SGCC Logo -->
                <img src="{{ asset('images/logo-sgcc.png') }}" alt="SGCC Logo"
                     class="w-24 h-24 mx-auto mb-2">

                <!-- User Name -->
                <div class="text-lg font-semibold text-white-custom">{{ Auth::user()->name }}</div>
            @else
                <div class="text-lg font-semibold text-white-custom">SGCC Bidding</div>
            @endauth
        </div>

        <!-- Role Switch -->
        <div class="mt-5 px-6 role-switch">
            <form method="POST" action="{{ route('switch.role') }}">
                @csrf
                <label for="role" class="block text-sm font-semibold text-white-custom mb-2">
                    Switch Mode
                </label>
                <div class="relative">
                    <select name="role" id="role" onchange="this.form.submit()"
                            class="block w-full appearance-none bg-white/20 text-white-custom text-sm font-medium px-4 py-2 rounded-xl backdrop-blur-md shadow-md border border-white/30
                            focus:outline-none focus:ring-2 focus:ring-yellow-300
                            focus:bg-yellow-500 hover:bg-yellow-400 transition-colors duration-200 ease-in-out">
                        <option value="user" {{ session('active_role') === 'user' ? 'selected' : '' }}>User Bidding</option>
                        <option value="tender" {{ session('active_role') === 'tender' ? 'selected' : '' }}>Tenders</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 px-4 space-y-1 text-sm flex-1 overflow-y-auto scrollbar-hidden">
            <!-- Home -->
            <a href="{{ route('home') }}" class="nav-item cursor-pointer {{ request()->routeIs('home') ? 'active' : '' }}">
                <div class="nav-content flex items-center p-3">
                    <div class="icon-container">
                        <i class="fas fa-home text-white nav-icon"></i>
                    </div>
                    <span class="font-medium text-white-custom nav-text">Home</span>
                </div>
                <div class="tooltip">Home</div>
            </a>

            <!-- Rules -->
            <a href="{{ route('rules') }}" class="nav-item cursor-pointer {{ request()->routeIs('rules') ? 'active' : '' }}">
                <div class="nav-content flex items-center p-3">
                    <div class="icon-container">
                        <i class="fas fa-book text-blue-300 nav-icon"></i>
                    </div>
                    <span class="font-medium text-white-custom nav-text">Rules</span>
                </div>
                <div class="tooltip">Rules</div>
            </a>

            <!-- Bidding Platform -->
            <div class="nav-item cursor-pointer" onclick="toggleSubmenu('bidding-submenu', this)">
                <div class="nav-content flex items-center p-3">
                    <div class="icon-container">
                        <i class="fas fa-gavel text-green-300 nav-icon"></i>
                    </div>
                    <span class="font-medium text-white-custom nav-text">Bidding Platform</span>
                    <i class="fas fa-chevron-down text-white-custom chevron-icon" id="bidding-chevron"></i>
                </div>
                <div class="tooltip">Bidding Platform</div>
            </div>
            <div class="submenu" id="bidding-submenu">
                <a href="{{ route('bidding.live') }}" class="submenu-item">
                    <i class="fas fa-hammer text-sm mr-2"></i>
                    Live Bidding
                </a>
                <a href="/winner" class="submenu-item">
                    <i class="fas fa-trophy text-sm mr-2"></i>
                    Winner
                </a>
                <a href="/history" class="submenu-item">
                    <i class="fas fa-history text-sm mr-2"></i>
                    History
                </a>
                <a href="/status" class="submenu-item">
                    <i class="fas fa-chart-line text-sm mr-2"></i>
                    Status
                </a>
            </div>

            <!-- Settings -->
            <div class="nav-item cursor-pointer" onclick="toggleSubmenu('settings-submenu', this)">
                <div class="nav-content flex items-center p-3">
                    <div class="icon-container">
                        <i class="fas fa-cog text-purple-300 nav-icon"></i>
                    </div>
                    <span class="font-medium text-white-custom nav-text">Settings</span>
                    <i class="fas fa-chevron-down text-white-custom chevron-icon" id="settings-chevron"></i>
                </div>
                <div class="tooltip">Settings</div>
            </div>
            <div class="submenu" id="settings-submenu">
                <a href="{{ route('profile') }}" class="submenu-item">
                    <i class="fas fa-user text-sm mr-2"></i>
                    Profile
                </a>
                <a href="{{ route('change-password.edit') }}" class="submenu-item">
                    <i class="fas fa-lock text-sm mr-2"></i>
                    Password
                </a>
            </div>

            <!-- Terms & Conditions -->
            <a href="/t&c" class="nav-item cursor-pointer {{ request()->routeIs('t&c') ? 'active' : '' }}">
                <div class="nav-content flex items-center p-3">
                    <div class="icon-container">
                        <i class="fas fa-file-alt text-orange-300 nav-icon"></i>
                    </div>
                    <span class="font-medium text-white-custom nav-text">Terms & Conditions</span>
                </div>
                <div class="tooltip">Terms & Conditions</div>
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gold logout-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full nav-item flex items-center space-x-4 p-3 rounded-xl bg-red-500/30 hover:bg-red-600/40 border border-red-400/50 relative">
                    <div class="nav-content flex items-center space-x-4 w-full">
                        <div class="icon-container bg-red-500/40">
                            <i class="fas fa-sign-out-alt text-white nav-icon"></i>
                        </div>
                        <span class="font-medium text-white nav-text">Logout</span>
                    </div>
                    <div class="tooltip">Logout</div>
                </button>
            </form>
        </div>
    </div>

    <button class="hamburger-btn" onclick="toggleSidebar()" id="hamburger-btn">
        <i class="fas fa-bars" id="hamburger-icon"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @yield('content')
    </div>

    <script>
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const icon = document.getElementById('hamburger-icon');

            if (window.innerWidth <= 768) {
                // Mobile behavior
                if (sidebar.classList.contains('mobile-active')) {
                    sidebar.classList.remove('mobile-active');
                    overlay.classList.remove('active');
                } else {
                    sidebar.classList.add('mobile-active');
                    overlay.classList.add('active');
                }
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                sidebarCollapsed = sidebar.classList.contains('collapsed');

                if (sidebarCollapsed) {
                    icon.className = 'fas fa-chevron-right';
                    // Close all submenus when collapsing
                    document.querySelectorAll('.submenu').forEach(menu => {
                        menu.classList.remove('open');
                    });
                    document.querySelectorAll('.chevron-icon').forEach(chevron => {
                        chevron.classList.remove('rotated');
                    });
                } else {
                    icon.className = 'fas fa-chevron-left';
                }
            }
        }

        function toggleSubmenu(submenuId, element) {
            // Don't open submenu if sidebar is collapsed
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('collapsed')) {
                return;
            }

            const submenu = document.getElementById(submenuId);
            const chevron = element.querySelector('.chevron-icon');

            if (submenu.classList.contains('open')) {
                submenu.classList.remove('open');
                chevron.classList.remove('rotated');
            } else {
                // Close all other submenus
                document.querySelectorAll('.submenu').forEach(menu => {
                    menu.classList.remove('open');
                });
                document.querySelectorAll('.chevron-icon').forEach(chev => {
                    chev.classList.remove('rotated');
                });

                // Open current submenu
                submenu.classList.add('open');
                chevron.classList.add('rotated');
            }
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            } else {
                sidebar.classList.remove('collapsed');
                sidebarCollapsed = false;
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger-btn');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !hamburger.contains(e.target) &&
                sidebar.classList.contains('mobile-active')) {
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
