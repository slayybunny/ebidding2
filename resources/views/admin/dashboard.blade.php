<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                radial-gradient(circle at 80% 20%, rgba(146, 108, 23, 0.05) 0%, transparent 50%);
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
            background: linear-gradient(135deg, #b8860b 0%, #926c17 100%);
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
            background: linear-gradient(135deg, #b8860b 0%, #926c17 100%);
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

        .logout-btn:hover .menu-icon {
            transform: scale(1.1);
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
            background: linear-gradient(135deg, #b8860b, #926c17);
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

        .welcome-section {
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease-out;
        }

        .welcome-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #b8860b 0%, #926c17 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-section p {
            color: #6b7280;
            font-size: 1.1rem;
            font-weight: 400;
        }

        .stats-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeInUp 0.8s ease-out;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #b8860b, #926c17, #a0751a);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stats-card:hover::before {
            opacity: 1;
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #d1d5db;
        }

        .stats-card .icon {
            font-size: 2.2rem;
            color: #b8860b;
            margin-bottom: 16px;
            transition: transform 0.3s ease;
        }

        .stats-card:hover .icon {
            transform: scale(1.1);
            color: #926c17;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 12px 0;
        }

        .stats-card .label {
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .content-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .content-card h5 {
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 24px;
            font-size: 1.25rem;
        }

        .table {
            color: #374151;
            position: relative;
            z-index: 5;
        }

        .table thead th {
            border: none;
            color: #4b5563;
            font-weight: 600;
            padding: 16px;
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            border: none;
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.3s ease;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-closed {
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #e5e7eb;
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

        .chart-container {
            position: relative;
            z-index: 5;
        }

        .category-legend {
            margin-top: 24px;
        }

        .category-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding: 10px 16px;
            background: #f8fafc;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .category-item:hover {
            background: #f1f5f9;
            transform: translateX(4px);
            border: 1px solid #e2e8f0;
        }

        .category-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .category-label {
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .welcome-admin {
            color: #4b5563;
            font-weight: 600;
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

        .trend-icon {
            color: #10b981;
            font-size: 1.2rem;
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

        .stats-card:nth-child(1) { animation-delay: 0.1s; }
        .stats-card:nth-child(2) { animation-delay: 0.2s; }
        .stats-card:nth-child(3) { animation-delay: 0.3s; }

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

            .welcome-section h2 {
                font-size: 2rem;
            }

            .stats-card {
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

        /* Card hover effects */
        .content-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Better focus states */
        .nav-link:focus {
            outline: 2px solid #b8860b;
            outline-offset: -2px;
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
                <h4 class="mb-0">DASHBOARD</h4>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 welcome-admin">WELCOME ADMIN!</span>
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
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home menu-icon"></i> Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('admin.manage_users') }}">
                        <i class="fas fa-users menu-icon"></i> Manage Users
                    </a>
                    <a class="nav-link" href="{{ route('admin.bidding.index') }}">
                        <i class="fas fa-gavel menu-icon"></i> Bidding Platform
                    </a>
                    <a class="nav-link" href="{{ route('admin.bidding-history.index') }}">
                        <i class="fas fa-history menu-icon"></i> Bidding History
                    </a>
                    <a class="nav-link" href="{{ route('admin.bidding-status.index') }}">
                        <i class="fas fa-chart-line menu-icon"></i> Bidding Status
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-book menu-icon"></i> Rules & User Manual   
                    </a>
                    <a class="nav-link" href="{{ route('admin.payments.index') }}">
                        <i class="fas fa-credit-card menu-icon"></i> Payment Records
                    </a>
                    <a class="nav-link" href="{{ route('admin.profit.report') }}">
                        <i class="fas fa-chart-line menu-icon"></i> Profit Report
                    </a>
                    <a class="nav-link" a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle menu-icon"></i> Profile
                    </a>

                </nav>

                <!-- Logout Section -->
                <div class="logout-section">
                    <button class="logout-btn" onclick="handleLogout()">
                        <i class="fas fa-sign-out-alt menu-icon"></i> Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>Welcome back, Admin!</h2>
                <p>It's the perfect time to manage your bidding platform</p>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="number">247</div>
                                <div class="label">Active Users</div>
                            </div>
                            <i class="fas fa-arrow-up trend-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="number">1,834</div>
                                <div class="label">Submitted Bids</div>
                            </div>
                            <i class="fas fa-arrow-up trend-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="number">23</div>
                                <div class="label">Awards This Week</div>
                            </div>
                            <i class="fas fa-arrow-up trend-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Auctions and Categories -->
            <div class="row">
                <div class="col-md-8">
                    <div class="content-card">
                        <h5 class="mb-3">
                            <i class="fas fa-gavel me-2" style="color: #b8860b;"></i>
                            Recent Auctions
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bidder Name</th>
                                        <th>Product</th>
                                        <th>Starting Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Siti Sarah</td>
                                        <td>Gold Necklace</td>
                                        <td>RM700</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ahmad Iqbal</td>
                                        <td>Gold Ring</td>
                                        <td>RM500</td>
                                        <td><span class="status-badge status-pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>John Doe</td>
                                        <td>Gold Bar</td>
                                        <td>RM400</td>
                                        <td><span class="status-badge status-closed">Closed</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Maria Santos</td>
                                        <td>Diamond Ring</td>
                                        <td>RM1,200</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Lee Wei Ming</td>
                                        <td>Gold Bracelet</td>
                                        <td>RM650</td>
                                        <td><span class="status-badge status-pending">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-pie me-2" style="color: #926c17;"></i>
                                Categories
                            </h5>
                            <i class="fas fa-info-circle" style="color: #6b7280;"></i>
                        </div>
                        <div class="text-center chart-container">
                            <canvas id="categoriesChart" width="200" height="200"></canvas>
                            <div class="category-legend">
                                <div class="category-item">
                                    <div class="category-dot" style="background-color: #b8860b;"></div>
                                    <span class="category-label">Gold Necklace</span>
                                </div>
                                <div class="category-item">
                                    <div class="category-dot" style="background-color: #926c17;"></div>
                                    <span class="category-label">Gold Ring</span>
                                </div>
                                <div class="category-item">
                                    <div class="category-dot" style="background-color: #a0751a;"></div>
                                    <span class="category-label">Gold Bar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const body = document.body;

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
            // Show confirmation dialog
            if (confirm('Are you sure you want to logout?')) {
                // Add logout animation
                document.body.style.opacity = '0.5';
                document.body.style.transition = 'opacity 0.3s ease';

                // Simulate logout process
                setTimeout(() => {
                    alert('Logged out successfully!');
                    // In a real application, redirect to login page
                    // window.location.href = '/login';

                    // Reset for demo
                    document.body.style.opacity = '1';
                }, 500);
            }
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const body = document.body;

            if (window.innerWidth > 768) {
                // Reset mobile classes when switching to desktop
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            } else {
                // Reset desktop classes when switching to mobile
                body.classList.remove('sidebar-collapsed');
                sidebarCollapsed = false;
            }
        });

        // Close sidebar when clicking outside on mobile
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

        // Navigation link active state
        document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');

        // Hanya preventDefault jika href bermula dengan #
        if (href.startsWith('#')) {
            e.preventDefault();

            // Remove active class dari semua
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Optional: tutup sidebar kat mobile
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('mobile-active');
                document.querySelector('.sidebar-overlay').classList.remove('active');
            }
        }
    });
});

        // Initialize Chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoriesChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Gold Necklace', 'Gold Ring', 'Gold Bar'],
                    datasets: [{
                        data: [40, 35, 25],
                        backgroundColor: ['#b8860b', '#926c17', '#a0751a'],
                        borderWidth: 0,
                        hoverOffset: 15,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 2000,
                        easing: 'easeOutQuart'
                    },
                    cutout: '65%'
                }
            });
        });

        // Add interactive animations to stats cards
        document.querySelectorAll('.stats-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;

            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
