<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - SIBIMA+</title>
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

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 3px solid #f1f5f9;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .page-header h2 .category-name {
            color: var(--primary-green);
            font-weight: 800;
        }

        /* Filter Card Styling */
        .filter-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }

        .filter-card .form-label {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .filter-card .input-group-text {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1.5px solid #d1d5db;
            border-right: none;
            color: #64748b;
            font-weight: 600;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .filter-card .input-group .form-control {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .filter-card .form-control:focus,
        .filter-card .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Product Card Styling */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .product-card::before {
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

        .product-card:hover::before {
            opacity: 1;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-green);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 220px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.1) rotate(2deg);
        }

        .product-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            z-index: 10;
        }

        .product-badge .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .product-body {
            padding: 1.5rem;
        }

        .product-body h6 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.75rem;
            font-size: 1.05rem;
            line-height: 1.4;
            min-height: 50px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-desc {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.6;
            min-height: 44px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-tag {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.75rem;
            display: block;
            letter-spacing: -0.5px;
        }

        .stock-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .stock-badge {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stock-badge i {
            font-size: 0.85rem;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            padding: 10px 16px;
            border-radius: 10px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-add-cart:active {
            transform: translateY(0);
        }

        .btn-detail {
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            background: white;
            font-weight: 700;
            transition: all 0.3s;
            padding: 10px 16px;
            border-radius: 10px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-detail:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* Button Styling */
        .btn-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            font-weight: 700;
            padding: 0.65rem 1.75rem;
            border-radius: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-green) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid #64748b;
            color: #64748b;
            background: white;
            padding: 0.65rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn-outline-secondary:hover {
            background: #64748b;
            color: white;
            border-color: #64748b;
            transform: scale(1.05);
        }

        .btn-secondary {
            background: #94a3b8;
            border: none;
            color: white;
            cursor: not-allowed;
        }

        /* Pagination Custom */
        .pagination-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 3rem;
            user-select: none;
        }

        .pagination-custom .arrow,
        .pagination-custom .page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 42px;
            height: 42px;
            padding: 0 14px;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
            text-decoration: none;
            color: #334155;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        .pagination-custom .arrow {
            font-size: 1.2rem;
        }

        .pagination-custom .arrow:hover:not(.disabled),
        .pagination-custom .page:hover:not(.active) {
            transform: translateY(-2px);
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .pagination-custom .page.active {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark));
            color: white;
            border-color: var(--primary-green);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .pagination-custom .arrow.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f1f5f9;
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

        /* Badge Styling */
        .bg-success {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark)) !important;
        }

        .bg-info {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6) !important;
        }

        /* Results Info */
        .results-info {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: inline-block;
            font-weight: 600;
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

            .product-card {
                margin-bottom: 1rem;
            }

            .product-image-wrapper {
                height: 200px;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }

            .filter-card {
                padding: 1.5rem;
            }

            .btn-outline-secondary {
                width: 100%;
                height: auto;
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

        .filter-card {
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .product-card {
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .product-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .product-card:nth-child(2) {
            animation-delay: 0.15s;
        }

        .product-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .product-card:nth-child(4) {
            animation-delay: 0.25s;
        }

        .product-card:nth-child(5) {
            animation-delay: 0.3s;
        }

        .product-card:nth-child(6) {
            animation-delay: 0.35s;
        }

        .product-card:nth-child(7) {
            animation-delay: 0.4s;
        }

        .product-card:nth-child(8) {
            animation-delay: 0.45s;
        }

        .product-card:nth-child(9) {
            animation-delay: 0.5s;
        }

        .product-card:nth-child(10) {
            animation-delay: 0.55s;
        }

        .product-card:nth-child(11) {
            animation-delay: 0.6s;
        }

        .product-card:nth-child(12) {
            animation-delay: 0.65s;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.produk') }}" class="{{ request()->routeIs('kostumer.produk') || request()->routeIs('kostumer.produk.kategori') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.keranjang') }}" class="{{ request()->routeIs('kostumer.keranjang') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Keranjang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kostumer.riwayat') }}" class="{{ request()->routeIs('kostumer.riwayat') ? 'active' : '' }}">
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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h2>
                @if(isset($kategori) && is_object($kategori))
                <i class="fas fa-box me-2"></i>Produk Kategori: <span class="category-name">{{ $kategori->nama_kategori }}</span>
                @elseif(request('kategori') && $kategoris->isNotEmpty())
                @php
                $selectedKategori = $kategoris->firstWhere('id_kategori', request('kategori'));
                @endphp
                @if($selectedKategori)
                <i class="fas fa-box me-2"></i>Produk Kategori: <span class="category-name">{{ $selectedKategori->nama_kategori }}</span>
                @else
                <i class="fas fa-boxes me-2"></i>Semua Produk
                @endif
                @else
                <i class="fas fa-boxes me-2"></i>Semua Produk
                @endif
            </h2>
        </div>

        <!-- Filter Section -->
        <div class="filter-card">
            <form action="{{ route('kostumer.produk') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label"><i class="fas fa-search me-2"></i>Cari Produk</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Masukkan nama produk..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="fas fa-layer-group me-2"></i>Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                    <a href="{{ route('kostumer.produk') }}" class="btn btn-outline-secondary" title="Reset Filter">
                        <i class="fas fa-sync"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($produks as $produk)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image-wrapper">
                        <span class="product-badge">
                            <span class="badge bg-success">{{ $produk->nama_kategori }}</span>
                        </span>
                        @if($produk->image_path && file_exists(public_path($produk->image_path)))
                        <img src="{{ asset($produk->image_path) }}"
                            class="product-image"
                            alt="{{ $produk->nama_b }}">
                        @else
                        @php
                        $productImages = [
                        'kipas angin' => 'kipas.jpg',
                        'kemeja polos' => 'kemeja.jpg',
                        'panci stainless' => 'panci.jpg',
                        'gelang aesthetic' => 'gelang.jpg',
                        'kopi arabica' => 'kopi.jpg',
                        'kalung mutiara sungai pakning' => 'mutiara.jpg',
                        'gelang rotan' => 'gelang.jpg',
                        'kerupuk basah' => 'kerupuk.jpg'
                        ];
                        $productImage = $productImages[strtolower($produk->nama_b)] ?? 'no-image.jpg';
                        @endphp
                        <img src="{{ asset('img/' . $productImage) }}"
                            class="product-image"
                            alt="{{ $produk->nama_b }}">
                        @endif
                    </div>
                    <div class="product-body">
                        <h6>{{ $produk->nama_b }}</h6>
                        <p class="product-desc">{{ Str::limit($produk->desc_b, 80) }}</p>
                        <span class="price-tag">Rp {{ number_format($produk->price, 0, ',', '.') }}</span>
                        <div class="stock-info">
                            <span class="stock-badge">
                                <i class="fas fa-box"></i>Stok: {{ $produk->stok_b }}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('kostumer.produk.detail', $produk->id_barang) }}" class="btn btn-detail btn-sm flex-grow-1">
                                <i class="fas fa-eye"></i>Detail
                            </a>
                            @if($produk->stok_b > 0)
                            <form action="{{ route('kostumer.keranjang.tambah') }}" method="POST" class="flex-grow-1">
                                @csrf
                                <input type="hidden" name="id_barang" value="{{ $produk->id_barang }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-add-cart btn-sm w-100">
                                    <i class="fas fa-cart-plus"></i>Beli
                                </button>
                            </form>
                            @else
                            <button class="btn btn-secondary btn-sm flex-grow-1" disabled>
                                <i class="fas fa-times-circle"></i>Habis
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>Tidak ada produk yang ditemukan.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-custom mt-4">
            @if($produks->onFirstPage())
            <span class="arrow disabled"><i class="fas fa-chevron-left"></i></span>
            @else
            <a href="{{ $produks->previousPageUrl() }}" class="arrow"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
            @if ($page == $produks->currentPage())
            <span class="page active">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="page">{{ $page }}</a>
            @endif
            @endforeach

            @if($produks->hasMorePages())
            <a href="{{ $produks->nextPageUrl() }}" class="arrow"><i class="fas fa-chevron-right"></i></a>
            @else
            <span class="arrow disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>