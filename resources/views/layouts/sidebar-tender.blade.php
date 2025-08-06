<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGCC Tender Dashboard</title>
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
            background: #fafbfc;
            min-height: 100vh;
            position: relative;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e1e5e9;
            color: #495057;
            height: 100vh;
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 28px 24px;
            border-bottom: 1px solid #e1e5e9;
            background: linear-gradient(135deg, #b8860b 0%, #daa520 100%);
            color: white;
        }

        .sidebar-header h4 {
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .sidebar-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .nav-link {
            color: #6c757d;
            padding: 18px 24px;
            margin: 2px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
            font-weight: 500;
            font-size: 0.95rem;
            border: none;
            text-decoration: none;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .sidebar .nav-link:hover {
            background: #f8f9fa;
            color: #b8860b;
            border-left: 4px solid #b8860b;
            padding-left: 20px;
        }

        .sidebar .nav-link.active {
            background: #f8f9fa;
            color: #b8860b;
            border-left: 4px solid #b8860b;
            padding-left: 20px;
            font-weight: 600;
        }

        .sidebar .nav-link.active .menu-icon {
            color: #b8860b;
        }

        .logout-section {
            margin-top: auto;
            padding: 20px 16px 28px 16px;
            border-top: 1px solid #e1e5e9;
        }

        .logout-btn {
            color: #dc3545;
            padding: 16px 24px;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            border: none;
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            background: transparent;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #f8f9fa;
            color: #dc3545;
            border-left: 4px solid #dc3545;
            padding-left: 20px;
        }

        .logout-btn .menu-icon {
            color: #dc3545;
            font-size: 1rem;
            margin-right: 12px;
            transition: all 0.2s ease;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e1e5e9;
            color: #b8860b;
            padding: 20px 32px;
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .top-navbar h4 {
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #b8860b;
            font-size: 1.4rem;
            margin: 0;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #b8860b, #daa520);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(184, 134, 11, 0.15);
            transition: transform 0.2s ease;
        }

        .user-avatar:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.2);
        }

        .main-content {
            margin-left: 280px;
            padding: 32px;
            padding-top: 100px;
            background: #fafbfc;
            min-height: 100vh;
            z-index: 1;
            position: relative;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-icon {
            font-size: 1rem;
            margin-right: 14px;
            transition: all 0.2s ease;
            color: #6c757d;
            width: 18px;
            text-align: center;
        }

        .nav-link:hover .menu-icon {
            color: #b8860b;
        }

        .nav-link.active .menu-icon {
            color: #b8860b;
        }

        .hamburger-btn {
            color: #6c757d;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 8px;
            border-radius: 6px;
            border: none;
            background: transparent;
            font-size: 1.1rem;
        }

        .hamburger-btn:hover {
            color: #b8860b;
            background: #f8f9fa;
        }

        .welcome-user {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        /* Submenu styles */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: #f8f9fa;
            border-radius: 6px;
            margin: 2px 16px;
            border: 1px solid #e9ecef;
        }

        .submenu.open {
            max-height: 300px;
            padding: 8px 0;
        }

        .submenu-link {
            color: #6c757d;
            padding: 14px 24px 14px 48px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .submenu-link:hover {
            color: #b8860b;
            background-color: #ffffff;
            border-left: 3px solid #b8860b;
            padding-left: 45px;
        }

        .submenu-link i {
            margin-right: 10px;
            font-size: 0.85rem;
            width: 14px;
            text-align: center;
        }

        .chevron-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.75rem;
            color: #adb5bd;
        }

        .chevron-icon.rotated {
            transform: rotate(180deg);
        }

        /* Role Switch */
        .role-switch {
            padding: 20px 16px;
            border-bottom: 1px solid #e1e5e9;
            background: #f8f9fa;
        }

        .role-switch label {
            display: block;
            margin-bottom: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-switch select {
            width: 100%;
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            background-color: white;
            font-size: 0.9rem;
            color: #495057;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .role-switch select:focus {
            outline: none;
            border-color: #b8860b;
            box-shadow: 0 0 0 2px rgba(184, 134, 11, 0.1);
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
            background: rgba(0, 0, 0, 0.3);
            z-index: 999;
            display: none;
            backdrop-filter: blur(1px);
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
                height: 65px;
            }

            .main-content {
                margin-left: 0;
                padding: 24px 20px;
                padding-top: 85px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 20px 16px;
                padding-top: 80px;
            }

            .top-navbar {
                padding: 12px 16px;
                height: 60px;
            }

            .top-navbar h4 {
                font-size: 1.1rem;
            }

            .welcome-user {
                font-size: 0.8rem;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f3f5;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #ced4da;
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #adb5bd;
        }

        /* Card styling for main content */
        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            padding: 32px;
            margin-bottom: 24px;
        }

        .page-header {
            background: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            padding: 24px 32px;
            margin-bottom: 32px;
        }

        .page-header h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.3px;
        }

        .page-header p {
            color: #6c757d;
            margin: 8px 0 0 0;
            font-size: 1rem;
        }

         main, .main-content {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Top Navigation -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="hamburger-btn me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="page-title">@yield('page-title', 'TENDER MANAGEMENT SYSTEM')</h4>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 welcome-user">WELCOME, {{ Auth::user()->name }}</span>
                <div class="user-avatar">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-building me-2"></i>SGCC TENDERS</h4>
            </div>

            <div class="role-switch">
                <form method="POST" action="{{ route('switch.role') }}" id="role-switch-form">
                    @csrf
                    <label for="role">OPERATING MODE</label>
                    <select name="role" id="role" onchange="switchRole()" class="form-select">
                        <option value="user" {{ session('active_role') === 'user' ? 'selected' : '' }}>User Bidding</option>
                        <option value="tender" {{ session('active_role') === 'tender' ? 'selected' : '' }}>Tender Management</option>
                    </select>
                </form>
            </div>

            <div class="sidebar-content">
                <nav class="nav flex-column pt-3">
                    <div class="nav-link" onclick="toggleSubmenu('gold-submenu')">
                        <i class="fas fa-coins menu-icon"></i> Gold Management
                        <i class="fas fa-chevron-down chevron-icon" id="gold-chevron"></i>
                    </div>
                    <div class="submenu" id="gold-submenu">
                        <a href="{{ route('create-listing') }}" class="submenu-link">
                            <i class="fas fa-plus"></i> Create Listing
                        </a>
                        <a href="{{ route('my-gold-items') }}" class="submenu-link">
                            <i class="fas fa-list"></i> My Gold Items
                        </a>
                    @php
    $listing = \App\Models\Listing::where('member_id', Auth::id())->latest()->first();
@endphp

<a href="{{ $listing ? route('listing-overview', ['slug' => $listing->slug]) : '#' }}" class="submenu-link {{ $listing ? '' : 'disabled' }}" {{ $listing ? '' : 'style=pointer-events:none;opacity:0.5;' }}>
    <i class="fas fa-eye"></i> Listing Overview
</a>

                    </div>
                </nav>

                <!-- Logout Section -->
                <div class="logout-section">
                    <button onclick="handleLogout()" class="logout-btn">
                        <i class="fas fa-sign-out-alt menu-icon"></i> Sign Out
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
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

        function handleLogout() {
            Swal.fire({
                title: 'Sign Out?',
                text: 'Are you sure you want to sign out from the system?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2c3e50',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, sign out',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
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
