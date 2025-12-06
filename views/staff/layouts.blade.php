<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Staff - SIBIMA+')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            background-color: white;
            color: #dc3545;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-left: 20px;
            padding-left: 20px;
            border-left: 2px solid rgba(255,255,255,0.3);
        }

        .logout-btn {
            background-color: white;
            color: #dc3545;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Layout Container */
        .main-container {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            padding: 20px 0;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 5px 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link i {
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            color: #dc3545;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: #dc3545;
            color: white;
        }

        .nav-link.active:hover {
            background-color: #c82333;
            transform: translateX(0);
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .header-left {
                width: 100%;
                justify-content: space-between;
            }

            .page-title {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <span class="logo-text">SIBIMA+</span>
            </div>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('staff.dashboard_staff') }}" class="nav-link {{ request()->routeIs('staff.dashboard_staff') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.kategori.index') }}" class="nav-link {{ request()->routeIs('staff.kategori.*') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.stok.index') }}" class="nav-link {{ request()->routeIs('staff.stok.*') ? 'active' : '' }}">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tambah Stok Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('staff.barang.index') }}" class="nav-link {{ request()->routeIs('staff.barang.*') ? 'active' : '' }}">
                            <i class="bi bi-database"></i>
                            <span>Data Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('staff.stok_barang.index') }}" class="nav-link {{ request()->routeIs('staff.stok_barang.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Stok Barang</span>
                    </a>
                </li>
                </ul>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>