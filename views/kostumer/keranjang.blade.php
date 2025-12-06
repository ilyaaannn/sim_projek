<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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

        .sidebar-menu a.active i {
            transform: scale(1.1);
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
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: var(--primary-green);
            font-size: 1.8rem;
        }

        /* Cart Card Styling */
        .cart-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s;
        }

        .cart-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .cart-header {
            padding: 1.75rem 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 2px solid #e2e8f0;
        }

        .cart-header h4 {
            margin: 0;
            color: #0f172a;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-header h4 i {
            color: var(--primary-green);
        }

        .cart-item {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item:hover {
            background: linear-gradient(90deg, #fafbfc 0%, #f8fafc 100%);
            transform: translateX(4px);
        }

        .cart-image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s;
        }

        .cart-image:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .product-price {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
        }

        .stock-info {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 20px;
            font-size: 0.85rem;
            color: #166534;
            font-weight: 600;
        }

        .stock-info i {
            color: var(--primary-green);
        }

        /* Quantity Control */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8fafc;
            padding: 6px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            max-width: 160px;
        }

        .quantity-control button {
            width: 40px;
            height: 40px;
            border: none;
            background: white;
            color: var(--primary-green);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .quantity-control button:hover {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .quantity-control button:active {
            transform: scale(0.95);
        }

        .quantity-control input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            color: #0f172a;
            background: white;
            font-size: 1.05rem;
        }

        .item-subtotal {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary-green);
            text-align: right;
        }

        /* Summary Card */
        .summary-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid #e2e8f0;
            position: sticky;
            top: calc(var(--navbar-height) + 2.5rem);
        }

        .summary-card h5 {
            color: #0f172a;
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: 1.35rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-card h5 i {
            color: var(--primary-green);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            color: #64748b;
            font-size: 1rem;
            border-bottom: 1px dashed #e2e8f0;
        }

        .summary-item:last-of-type {
            border-bottom: 2px solid #e2e8f0;
        }

        .summary-item span:last-child {
            font-weight: 700;
            color: #334155;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 12px;
            border: 2px solid #bbf7d0;
        }

        .summary-total span:first-child {
            color: #0f172a;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .summary-total .amount {
            color: var(--primary-green);
            font-size: 1.75rem;
            font-weight: 900;
        }

        /* Checkout Button */
        .btn-checkout {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 1rem;
            border-radius: 12px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 1.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
            font-size: 1.05rem;
            text-decoration: none;
        }

        .btn-checkout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-checkout:active {
            transform: translateY(-1px);
        }

        .checkout-note {
            margin-top: 1.25rem;
            padding: 1rem;
            background: #f1f5f9;
            border-radius: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }

        .checkout-note i {
            color: #3b82f6;
        }

        /* Empty Cart */
        .empty-cart {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-cart-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-cart-icon i {
            font-size: 3.5rem;
            color: #94a3b8;
        }

        .empty-cart h4 {
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .empty-cart p {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        /* Buttons */
        .btn-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            font-weight: 700;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid #64748b;
            color: #64748b;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: #64748b;
            color: white;
            border-color: #64748b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(100, 116, 139, 0.3);
        }

        .btn-outline-danger {
            border: 2px solid #ef4444;
            color: #ef4444;
            padding: 0.5rem 0.75rem;
            border-radius: 10px;
            background: white;
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn-outline-danger:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

            .cart-image {
                width: 90px;
                height: 90px;
            }

            .summary-card {
                margin-top: 2rem;
                position: static;
            }

            .page-header h2 {
                font-size: 1.5rem;
            }

            .cart-item {
                padding: 1.25rem 1rem;
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

        .cart-card {
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .summary-card {
            animation: slideInRight 0.6s ease-out backwards;
            animation-delay: 0.2s;
        }

        .cart-item {
            animation: fadeInUp 0.4s ease-out backwards;
        }

        .cart-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .cart-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .cart-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .cart-item:nth-child(4) {
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

        <!-- Page Header -->
        <div class="page-header">
            <h2>
                <i class="fas fa-shopping-cart"></i>Keranjang Belanja
            </h2>
        </div>

        @if(empty($keranjang) || count($keranjang) == 0)
        <div class="cart-card">
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h4>Keranjang Anda Kosong</h4>
                <p>Belum ada produk di keranjang Anda. Mari mulai berbelanja!</p>
                <a href="{{ route('kostumer.produk') }}" class="btn btn-success">
                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                </a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-card">
                    <div class="cart-header">
                        <h4><i class="fas fa-shopping-bag"></i>Produk dalam Keranjang ({{ count($keranjang) }})</h4>
                    </div>

                    @foreach($keranjang as $id => $item)
                    <div class="cart-item">
                        <div class="row align-items-center">
                            <!-- Product Image -->
                            <div class="col-md-2 col-sm-3 mb-3 mb-md-0">
                                <img src="{{ $item['image_path'] ? asset($item['image_path']) : 'https://via.placeholder.com/110x110?text=No+Image' }}"
                                    class="cart-image"
                                    alt="{{ $item['nama_b'] }}"
                                    onerror="this.src='https://via.placeholder.com/110x110?text=No+Image'">
                            </div>

                            <!-- Product Info -->
                            <div class="col-md-4 col-sm-9 mb-3 mb-md-0">
                                <h6 class="product-name">{{ $item['nama_b'] }}</h6>
                                <p class="product-price mb-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                <span class="stock-info">
                                    <i class="fas fa-box"></i>Stok: {{ $item['stok_b'] }}
                                </span>
                            </div>

                            <!-- Quantity Control -->
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <form action="{{ route('kostumer.keranjang.update', $id) }}" method="POST" id="form-{{ $id }}">
                                    @csrf
                                    <div class="quantity-control">
                                        <button type="button" onclick="updateQuantity({{ $id }}, -1, {{ $item['stok_b'] }})">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" id="qty-{{ $id }}" value="{{ $item['quantity'] }}"
                                            min="1" max="{{ $item['stok_b'] }}" readonly>
                                        <button type="button" onclick="updateQuantity({{ $id }}, 1, {{ $item['stok_b'] }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Subtotal -->
                            <div class="col-md-2 col-sm-3 mb-3 mb-md-0">
                                <div class="item-subtotal">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Remove Button -->
                            <div class="col-md-1 col-sm-3 text-end">
                                <form action="{{ route('kostumer.keranjang.hapus', $id) }}" method="POST"
                                    onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <a href="{{ route('kostumer.produk') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>Lanjut Belanja
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5><i class="fas fa-receipt"></i>Ringkasan Belanja</h5>

                    <div class="summary-item">
                        <span>Total Item</span>
                        <span>{{ count($keranjang) }} produk</span>
                    </div>

                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-total">
                        <span>Total Pembayaran</span>
                        <span class="amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('kostumer.checkout') }}" class="btn-checkout">
                        <i class="fas fa-check-circle"></i>Proses Checkout
                    </a>

                    <div class="checkout-note">
                        <i class="fas fa-info-circle me-1"></i>Pajak dan ongkir akan dihitung saat checkout
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateQuantity(id, change, maxStock) {
            const input = document.getElementById('qty-' + id);
            let currentValue = parseInt(input.value);
            let newValue = currentValue + change;

            if (newValue >= 1 && newValue <= maxStock) {
                input.value = newValue;
                document.getElementById('form-' + id).submit();
            }
        }
    </script>
</body>

</html>