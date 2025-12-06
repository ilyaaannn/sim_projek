<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_b }} - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #10b981;
            --primary-dark: #059669;
            --light-blue: #f0f9ff;
            --sidebar-width: 280px;
            --navbar-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            height: calc(100vh - var(--navbar-height));
            width: var(--sidebar-width);
            background: white;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.08);
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
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, transparent 100%);
            color: var(--primary-green);
        }

        .sidebar-menu i {
            width: 24px;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            border: 1px solid #e5e7eb;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #6b7280;
            font-weight: 600;
        }

        /* Product Detail Card */
        .product-detail-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 3rem;
            border: 1px solid #e5e7eb;
            animation: fadeInUp 0.6s ease-out;
        }

        .product-image-main {
            width: 100%;
            height: 400px;
            object-fit: contain;
            border-radius: 12px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            transition: transform 0.5s ease;
        }

        .product-image-main:hover {
            transform: scale(1.02);
        }

        .product-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark));
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .product-price {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-green), #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        .stock-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .stock-badge {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .stock-available {
            color: #10b981;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .stock-out {
            color: #ef4444;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Product Description */
        .description-section {
            margin: 2rem 0;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 12px;
            border-left: 4px solid var(--primary-green);
        }

        .description-title {
            color: #1e293b;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .description-content {
            color: #4b5563;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Quantity Control */
        .quantity-control-wrapper {
            margin: 2rem 0;
        }

        .quantity-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 15px;
            max-width: 200px;
        }

        .quantity-btn {
            width: 48px;
            height: 48px;
            border: 2px solid #d1d5db;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1.2rem;
            color: #374151;
        }

        .quantity-btn:hover {
            background: #f3f4f6;
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .quantity-input {
            width: 80px;
            height: 48px;
            text-align: center;
            border: 2px solid #d1d5db;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .quantity-input:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            outline: none;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 12px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex: 1;
        }

        .btn-add-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-back {
            background: white;
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 12px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-back:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-3px);
        }

        /* Related Products Section */
        .related-products-section {
            margin-top: 3rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), #3b82f6);
            border-radius: 2px;
        }

        /* Related Product Card */
        .related-product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e5e7eb;
        }

        .related-product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.15);
            border-color: var(--primary-green);
        }

        .related-product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            transition: transform 0.5s ease;
        }

        .related-product-card:hover .related-product-image {
            animation: gentleZoom 3s ease-in-out infinite;
        }

        @keyframes gentleZoom {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .related-product-body {
            padding: 1.25rem;
        }

        .related-product-title {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            line-height: 1.4;
            min-height: 44px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-product-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }

        .related-product-stock {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn-view-detail {
            background: white;
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-view-detail:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left-color: var(--primary-green);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left-color: #dc2626;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border-left-color: #3b82f6;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .navbar-custom {
                padding: 0 1rem;
            }

            .product-detail-card {
                padding: 1.5rem;
            }

            .product-image-main {
                height: 300px;
                margin-bottom: 1.5rem;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.75rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-add-cart,
            .btn-back {
                width: 100%;
            }
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
                <a href="{{ route('kostumer.produk') }}" class="{{ request()->routeIs('kostumer.produk') ? 'active' : '' }}">
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

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kostumer.produk') }}">Produk</a></li>
                <li class="breadcrumb-item active">{{ $produk->nama_b }}</li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="product-detail-card">
            <div class="row g-5">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img src="{{ asset($produk->image_path) }}"
                            class="product-image-main"
                            alt="{{ $produk->nama_b }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-badge">{{ $produk->nama_kategori }}</div>
                    <h1 class="product-title">{{ $produk->nama_b }}</h1>

                    <div class="product-price">
                        Rp {{ number_format($produk->price, 0, ',', '.') }}
                    </div>

                    <div class="stock-info">
                        <span class="stock-badge">Stok: {{ $produk->stok_b }} unit</span>
                        @if($produk->stok_b > 0)
                        <span class="stock-available"><i class="fas fa-check-circle me-1"></i> Tersedia</span>
                        @else
                        <span class="stock-out"><i class="fas fa-times-circle me-1"></i> Habis</span>
                        @endif
                    </div>

                    <div class="description-section">
                        <h5 class="description-title">Deskripsi Produk</h5>
                        <p class="description-content">{{ $produk->desc_b }}</p>
                    </div>

                    @if($produk->stok_b > 0)
                    <form action="{{ route('kostumer.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_barang" value="{{ $produk->id_barang }}">

                        <div class="quantity-control-wrapper">
                            <div class="quantity-label">Jumlah</div>
                            <div class="quantity-control">
                                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" id="quantity" class="quantity-input"
                                    value="1" min="1" max="{{ $produk->stok_b }}">
                                <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                            </button>
                            <a href="{{ route('kostumer.produk') }}" class="btn-back">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-danger mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i> Produk ini sedang tidak tersedia
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('kostumer.produk') }}" class="btn-back w-100">
                            <i class="fas fa-arrow-left"></i> Kembali ke Produk
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($produkTerkait->count() > 0)
        <div class="related-products-section">
            <h3 class="section-title">Produk Terkait</h3>
            <div class="row g-4">
                @foreach($produkTerkait as $related)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="related-product-card">
                        <img src="{{ asset($related->image_path ?? 'img/no-image.jpg') }}"
                            class="related-product-image"
                            alt="{{ $related->nama_b }}">
                        <div class="related-product-body">
                            <h6 class="related-product-title">{{ $related->nama_b }}</h6>
                            <div class="related-product-price">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </div>
                            <span class="related-product-stock">Stok: {{ $related->stok_b }}</span>
                            <a href="{{ route('kostumer.produk.detail', $related->id_barang) }}" class="btn-view-detail">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const maxStock = {
            {
                $produk - > stok_b
            }
        };

        function increaseQuantity() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            if (value < maxStock) {
                input.value = value + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        // Validasi input quantity
        document.getElementById('quantity').addEventListener('change', function() {
            let value = parseInt(this.value);
            if (value < 1) {
                this.value = 1;
            } else if (value > maxStock) {
                this.value = maxStock;
            }
        });
    </script>
</body>

</html>