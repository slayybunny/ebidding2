<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGCC User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dashboard-container {
            background: #f8fafc;
            min-height: 100vh;
            position: relative;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .dashboard-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(184, 134, 11, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(161, 98, 7, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .sidebar {
            background: white;
            border-right: 1px solid #e5e7eb;
            color: #374151;
            height: 100vh;
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #b8860b 0%, #cd853f 100%);
            color: white;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
        }

        .sidebar-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .nav-link {
            color: #6b7280;
            padding: 16px 24px;
            margin: 4px 16px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-weight: 500;
            border: 1px solid transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background: #f3f4f6;
            color: #b8860b;
            transform: translateX(4px);
            border: 1px solid #e5e7eb;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #b8860b 0%, #cd853f 100%);
            color: white;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.3);
            border: 1px solid #b8860b;
        }

        .sidebar .nav-link.active .menu-icon {
            color: white;
        }

        .logout-section {
            margin-top: auto;
            padding: 24px 16px 24px 16px;
            border-top: 1px solid #e5e7eb;
        }

        .logout-btn {
            color: #dc2626;
            padding: 16px 24px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            border: 1px solid transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            background: transparent;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #fef2f2;
            color: #dc2626;
            transform: translateX(4px);
            border: 1px solid #fecaca;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.1);
        }

        .logout-btn .menu-icon {
            color: #dc2626;
            font-size: 1.1rem;
            margin-right: 12px;
            transition: all 0.3s ease;
        }

        .top-navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
            padding: 20px 32px;
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 999;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .top-navbar h4 {
            font-weight: 700;
            letter-spacing: 1px;
            color: #1f2937;
            font-size: 1.5rem;
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

        .main-content {
            margin-left: 280px;
            margin-top: 84px;
            padding: 32px;
            position: relative;
            z-index: 5;
            background: transparent;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-icon {
            font-size: 1.1rem;
            margin-right: 12px;
            transition: all 0.3s ease;
            color: #6b7280;
        }

        .nav-link:hover .menu-icon {
            transform: scale(1.1);
            color: #b8860b;
        }

        .nav-link.active .menu-icon {
            color: white;
        }

        .hamburger-btn {
            color: #4b5563;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
            border: none;
            background: transparent;
        }

        .hamburger-btn:hover {
            color: #b8860b;
            background: #f3f4f6;
        }

        .welcome-user {
            color: #4b5563;
            font-weight: 600;
        }

        /* Submenu styles */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: #f9fafb;
            border-radius: 8px;
            margin: 4px 16px;
        }

        .submenu.open {
            max-height: 300px;
            padding: 8px 0;
        }

        .submenu-link {
            color: #6b7280;
            padding: 12px 24px 12px 48px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .submenu-link:hover {
            color: #b8860b;
            background-color: #f3f4f6;
        }

        .submenu-link i {
            margin-right: 8px;
            font-size: 0.8rem;
        }

        .chevron-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        /* Role Switch */
        .role-switch {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .role-switch label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
        }

        .role-switch select {
            width: 100%;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background-color: white;
            font-size: 0.9rem;
            color: #374151;
            transition: all 0.3s ease;
        }

        .role-switch select:focus {
            outline: none;
            border-color: #b8860b;
            box-shadow: 0 0 0 3px rgba(184, 134, 11, 0.1);
        }

        /* Sidebar Toggle States */
        .sidebar-collapsed .sidebar {
            transform: translateX(-280px);
        }

        .sidebar-collapsed .top-navbar {
            left: 0;
        }

        .sidebar-collapsed .main-content {
            margin-left: 0;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 999;
            display: none;
            backdrop-filter: blur(2px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }

            .sidebar.mobile-active {
                transform: translateX(0);
            }

            .top-navbar {
                left: 0;
                padding: 16px 20px;
            }

            .main-content {
                margin-left: 0;
                margin-top: 70px;
                padding: 20px;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Top Navigation -->
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="hamburger-btn me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="page-title">@yield('page-title', 'USER DASHBOARD')</h4>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 welcome-user">WELCOME, {{ Auth::user()->name }}!</span>
                <div class="user-avatar">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-gem me-2"></i>SGCC Bidding</h4>
            </div>

            <div class="role-switch">
                <form method="POST" action="{{ route('switch.role') }}" id="role-switch-form">
                    @csrf
                    <label for="role">Switch Mode</label>
                    <select name="role" id="role" onchange="switchRole()" class="form-select">
                        <option value="user" {{ session('active_role') === 'user' ? 'selected' : '' }}>User Bidding</option>
                        <option value="tender" {{ session('active_role') === 'tender' ? 'selected' : '' }}>Tenders</option>
                    </select>
                </form>
            </div>

            <div class="sidebar-content">
                <nav class="nav flex-column pt-3">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home menu-icon"></i> Home
                    </a>

                    <a class="nav-link {{ request()->routeIs('rules') ? 'active' : '' }}" href="{{ route('rules') }}">
                        <i class="fas fa-book menu-icon"></i> Rules
                    </a>

                    <div class="nav-link" onclick="toggleSubmenu('bidding-submenu')">
                        <i class="fas fa-gavel menu-icon"></i> Bidding Platform
                        <i class="fas fa-chevron-down chevron-icon" id="bidding-chevron"></i>
                    </div>
                    <div class="submenu" id="bidding-submenu">
                        <a href="{{ route('bidding.live') }}" class="submenu-link">
                            <i class="fas fa-hammer"></i> Live Bidding
                        </a>
                        <a href="/winner" class="submenu-link">
                            <i class="fas fa-trophy"></i> Winner
                        </a>
                        <a href="/history" class="submenu-link">
                            <i class="fas fa-history"></i> History
                        </a>
                        <a href="/status" class="submenu-link">
                            <i class="fas fa-chart-line"></i> Status
                        </a>
                    </div>

                    <div class="nav-link" onclick="toggleSubmenu('settings-submenu')">
                        <i class="fas fa-cog menu-icon"></i> Settings
                        <i class="fas fa-chevron-down chevron-icon" id="settings-chevron"></i>
                    </div>
                    <div class="submenu" id="settings-submenu">
                        <a href="{{ route('profile') }}" class="submenu-link">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <a href="{{ route('change-password.edit') }}" class="submenu-link">
                            <i class="fas fa-lock"></i> Password
                        </a>
                    </div>

                    <a class="nav-link {{ request()->routeIs('t&c') ? 'active' : '' }}" href="/t&c">
                        <i class="fas fa-file-alt menu-icon"></i> Terms & Conditions
                    </a>
                </nav>

                <!-- Logout Section -->
                <div class="logout-section">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt menu-icon"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const body = document.body;

            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains('mobile-active')) {
                    sidebar.classList.remove('mobile-active');
                    overlay.classList.remove('active');
                } else {
                    sidebar.classList.add('mobile-active');
                    overlay.classList.add('active');
                }
            } else {
                if (sidebarCollapsed) {
                    body.classList.remove('sidebar-collapsed');
                    sidebarCollapsed = false;
                } else {
                    body.classList.add('sidebar-collapsed');
                    sidebarCollapsed = true;
                }
            }
        }

        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('-submenu', '-chevron'));

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

        function switchRole() {
            document.getElementById('role-switch-form').submit();
        }

        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const body = document.body;

            if (window.innerWidth > 768) {
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            } else {
                body.classList.remove('sidebar-collapsed');
                sidebarCollapsed = false;
            }
        });

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.querySelector('.hamburger-btn');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !hamburger.contains(e.target) &&
                sidebar.classList.contains('mobile-active')) {
                sidebar.classList.remove('mobile-active');
                document.querySelector('.sidebar-overlay').classList.remove('active');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
