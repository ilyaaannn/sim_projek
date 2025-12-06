<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kostumer - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --light-blue: #f0f9ff;
            --sidebar-width: 280px;
            --navbar-height: 70px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Navbar Styling */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 800;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            font-size: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary-green);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            height: calc(100vh - var(--navbar-height));
            width: var(--sidebar-width);
            background: white;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.06);
            z-index: 100;
            overflow-y: auto;
            padding: 2rem 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
            padding: 0 1rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-weight: 500;
            border-radius: 12px;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            color: var(--primary-green);
            transform: translateX(4px);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .sidebar-menu i {
            width: 24px;
            margin-right: 15px;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2.5rem;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2.5rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: 20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-banner h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .welcome-banner p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: var(--shadow-md);
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-green), var(--primary-dark));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.75rem;
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: var(--primary-green);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #3b82f6;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%);
            color: #a855f7;
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            color: #f97316;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .action-card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            border-color: var(--primary-green);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .action-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-light) 0%, #a7f3d0 100%);
            color: var(--primary-green);
        }

        .action-label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
        }

        /* Section Headers */
        .section-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            position: relative;
            display: inline-block;
        }

        .section-header h2::before {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), #3b82f6);
            border-radius: 2px;
        }

        .btn-view-all {
            background: white;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-all:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        /* Category Card Styling */
        .category-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            min-height: 260px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), #3b82f6);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-green);
        }

        .category-image-wrapper {
            width: 110px;
            height: 110px;
            margin: 0 auto 1.25rem;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            border: 3px solid #f0f9ff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
            background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%);
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.1) rotate(5deg);
        }

        .category-image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 1;
        }

        .category-card:hover .category-image-wrapper::before {
            opacity: 1;
        }

        .category-card h6 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .category-card p {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 4px solid var(--primary-green);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .navbar-custom {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .welcome-banner h1 {
                font-size: 1.6rem;
            }

            .welcome-banner p {
                font-size: 1rem;
            }

            .category-image-wrapper {
                width: 90px;
                height: 90px;
            }

            .user-info span {
                display: none;
            }
        }

        /* Animations */
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .welcome-banner {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .stat-card {
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .action-card {
            animation: fadeInUp 0.4s ease-out backwards;
        }

        .action-card:nth-child(1) {
            animation-delay: 0.15s;
        }

        .action-card:nth-child(2) {
            animation-delay: 0.25s;
        }

        .action-card:nth-child(3) {
            animation-delay: 0.35s;
        }

        .action-card:nth-child(4) {
            animation-delay: 0.45s;
        }

        .category-card {
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .category-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .category-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .category-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .category-card:nth-child(4) {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>
        <div class="navbar-right">
            <div class="user-info">
                <span>{{ Session::get('user.username') }}</span>
                <div class="user-avatar">
                    {{ strtoupper(substr(Session::get('user.username'), 0, 1)) }}
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="active">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.produk') }}">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.keranjang') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Keranjang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.riwayat') }}">
                    <i class="fas fa-history"></i>
                    <span>Riwayat Pesanan</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log-out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-content">
                <h1>Selamat Datang, {{ Session::get('user.username') }}! 👋</h1>
                <p>Sistem Informasi Bisnis - Platform Pembelian UMKM Bengkalis</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-value">{{ $totalProduk ?? 0 }}</div>
                <div class="stat-label">Total Produk Tersedia</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-value">{{ count($kategoris) }}</div>
                <div class="stat-label">Kategori Produk</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value">{{ $itemKeranjang ?? 0 }}</div>
                <div class="stat-label">Item di Keranjang</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-value">{{ $totalPesanan ?? 0 }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <section class="mb-5">
            <div class="section-header">
                <h2>Aksi Cepat</h2>
            </div>

            <div class="quick-actions">
                <a href="{{ route('kostumer.produk') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="action-label">Belanja Sekarang</div>
                </a>

                <a href="{{ route('kostumer.keranjang') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="action-label">Lihat Keranjang</div>
                </a>

                <a href="{{ route('kostumer.riwayat') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-label">Riwayat Pesanan</div>
                </a>
            </div>
        </section>

        <!-- Kategori Section -->
        <section class="mb-5">
            <div class="section-header">
                <h2>Kategori Produk</h2>
                <a href="{{ route('kostumer.produk') }}" class="btn-view-all">
                    <i class="fas fa-th me-2"></i>Lihat Semua
                </a>
            </div>

            <div class="row g-4">
                @foreach($kategoris as $kategori)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('kostumer.produk.kategori', $kategori->id_kategori) }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-image-wrapper">
                                @if($kategori->gambar_path && file_exists(public_path($kategori->gambar_path)))
                                <img src="{{ asset($kategori->gambar_path) }}"
                                    class="category-image"
                                    alt="{{ $kategori->nama_kategori }}">
                                @else
                                @php
                                $localImages = [
                                'elektronik' => 'elektronik.jpg',
                                'pakaian' => 'pakaian.jpg',
                                'peralatan rumah' => 'peralatan_rumah.jpg',
                                'aksesoris' => 'aksesoris.jpg',
                                'makanan & minuman' => 'makanan_minuman.jpg',
                                'kerajinan tangan' => 'kerajinan_tangan.jpg',
                                'produk laut' => 'produk_laut.jpg',
                                'herbal & produk alam' => 'herbal_alami.jpg',
                                'oleh-oleh khas bengkalis' => 'oleh_oleh.jpg',
                                ];
                                $imageName = $localImages[strtolower($kategori->nama_kategori)] ?? 'category-icon.png';
                                @endphp
                                <img src="{{ asset('img/' . $imageName) }}"
                                    class="category-image"
                                    alt="{{ $kategori->nama_kategori }}">
                                @endif
                            </div>
                            <h6>{{ $kategori->nama_kategori }}</h6>
                            <p>{{ Str::limit($kategori->deskripsi, 60) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
