<!-- File: resources/views/layouts/admin/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
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

        .admin-avatar {
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

        .admin-avatar:hover {
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

        .welcome-admin {
            color: #4b5563;
            font-weight: 600;
        }

        /* Profile Specific Styles */
        .profile-header {
            background: white;
            border-radius: 20px;
            padding: 0;
            margin-bottom: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .profile-cover {
            height: 180px;
            background: linear-gradient(135deg, #b8860b 0%, #cd853f 50%, #daa520 100%);
            position: relative;
            overflow: hidden;
        }

        .profile-cover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }

        .profile-avatar-container {
            position: absolute;
            bottom: -50px;
            left: 40px;
            z-index: 10;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            border: 6px solid white;
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-avatar i {
            font-size: 3rem;
            color: #b8860b;
        }

        .profile-info {
            padding: 70px 40px 40px 40px;
            position: relative;
        }

        .edit-profile-btn {
            position: absolute;
            top: 30px;
            right: 40px;
            background: linear-gradient(135deg, #b8860b 0%, #cd853f 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.3);
        }

        .edit-profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(184, 134, 11, 0.4);
            background: linear-gradient(135deg, #a0751a 0%, #b8860b 100%);
        }

        .profile-name {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #b8860b 0%, #cd853f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-role {
            color: #6b7280;
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .profile-id {
            color: #9ca3af;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .profile-details {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            animation: fadeInUp 1s ease-out;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 12px;
            color: #b8860b;
            font-size: 1.25rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .detail-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #b8860b, #cd853f);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .detail-item:hover {
            background: #f1f5f9;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #e2e8f0;
        }

        .detail-item:hover::before {
            opacity: 1;
        }

        .detail-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .detail-label i {
            margin-right: 8px;
            color: #b8860b;
            font-size: 1rem;
        }

        .detail-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-badge i {
            margin-right: 4px;
            font-size: 0.75rem;
        }

        .last-login {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
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

            .profile-info {
                padding: 70px 24px 32px 24px;
            }

            .edit-profile-btn {
                position: static;
                margin-top: 16px;
                width: 100%;
            }

            .profile-name {
                font-size: 1.875rem;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .profile-avatar-container {
                left: 24px;
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

        /* Button Focus States */
        .edit-profile-btn:focus,
        .logout-btn:focus {
            outline: 2px solid #b8860b;
            outline-offset: 2px;
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
                <h4 class="page-title">@yield('page-title', 'ADMIN DASHBOARD')</h4>

            </div>
            @php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="d-flex align-items-center">
    <span class="me-3 welcome-admin">
        WELCOME, {{ $admin->name ?? 'ADMIN' }}!
    </span>
    <div class="admin-avatar">
        <i class="fas fa-user text-white"></i>
    </div>
</div>

        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-chart-line me-2"></i>Admin Panel</h4>
            </div>
            <div class="sidebar-content">
                <nav class="nav flex-column pt-3">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
    <i class="fas fa-home menu-icon"></i> Dashboard
</a>

<a class="nav-link {{ request()->routeIs('admin.manage_users') ? 'active' : '' }}" href="{{ route('admin.manage_users') }}">
    <i class="fas fa-users menu-icon"></i> Manage Users
</a>

<a class="nav-link {{ request()->routeIs('admin.bidding') ? 'active' : '' }}" href="{{ route('admin.bidding.index') }}">
    <i class="fas fa-gavel menu-icon"></i> Bidding Platform
</a>

<a class="nav-link {{ request()->routeIs('admin.bidding-history.index') ? 'active' : '' }}" href="{{ route('admin.bidding-history.index') }}">
    <i class="fas fa-history menu-icon"></i> Bidding History
</a>

<a class="nav-link {{ request()->routeIs('admin.bidding-status.index') ? 'active' : '' }}" href="{{ route('admin.bidding-status.index') }}">
    <i class="fas fa-chart-line menu-icon"></i> Bidding Status
</a>

<a class="nav-link {{ request()->routeIs('admin.payments.index') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
    <i class="fas fa-credit-card menu-icon"></i> Payment Records
</a>

<a class="nav-link {{ request()->routeIs('admin.profit.report') ? 'active' : '' }}" href="{{ route('admin.profit.report') }}">
    <i class="fas fa-chart-line menu-icon"></i> Profit Report
</a>

<!--<a class="nav-link {{ request()->routeIs('admin.rules_manual') ? 'active' : '' }}" href="{{ route('admin.rules_manual') }}">
    <i class="fas fa-book-open menu-icon"></i> Rules & Manual
</a>-->

<!--<a class="nav-link {{ request()->routeIs('admin.reports.profit.form') ? 'active' : '' }}" href="{{ route('admin.reports.profit.form') }}">
    <i class="fas fa-chart-line menu-icon"></i> Reporting
</a>-->


<a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
    <i class="fas fa-user-circle menu-icon"></i> Profile
</a>


                </nav>

                <!-- Logout Section -->
                <div class="logout-section">
                    <button class="logout-btn" onclick="handleLogout()">
                        <i class="fas fa-sign-out-alt menu-icon"></i> Logout
                    </button>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Main-->
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

        function handleLogout() {
    Swal.fire({
        title: 'Log Out?',
        text: 'Are you sure you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, log out',
        cancelButtonText: 'Cancel',
        reverseButtons: true
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
            const overlay = document.querySelector('.sidebar-overlay');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !hamburger.contains(e.target) &&
                sidebar.classList.contains('mobile-active')) {
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                if (href.startsWith('#')) {
                    e.preventDefault();

                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    if (window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('mobile-active');
                        document.querySelector('.sidebar-overlay').classList.remove('active');
                    }
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
