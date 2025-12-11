<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Checkout Card */
        .checkout-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            animation: fadeInUp 0.5s ease-out;
        }

        .checkout-card h5 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
        }

        .checkout-card hr {
            border-color: #e2e8f0;
            margin: 1.5rem 0;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-control:read-only {
            background: #f8fafc;
            color: #64748b;
        }

        /* Order Item */
        .order-item {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.3s;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item:hover {
            background: #f8fafc;
        }

        .item-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 12px;
            background: #f5f5f5;
            border: 2px solid #f0f9ff;
            margin-right: 1.25rem;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-details h6 {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .item-details p {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        .item-price {
            text-align: right;
        }

        .item-price .price-value {
            font-weight: 700;
            color: var(--primary-green);
            font-size: 1.1rem;
        }

        /* Summary Card */
        .summary-card {
            position: sticky;
            top: calc(var(--navbar-height) + 2rem);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            color: #475569;
        }

        .summary-row.total {
            border-top: 2px solid #e2e8f0;
            padding-top: 1.25rem;
            margin-top: 0.75rem;
        }

        .summary-row.total .label {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .summary-row.total .value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-green);
        }

        /* Buttons */
        .btn-order {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 1rem 1.5rem;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #475569;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow-sm);
            font-weight: 500;
            animation: fadeInDown 0.4s ease-out;
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

        .badge-shipping {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
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
                padding: 1.5rem;
            }

            .navbar-custom {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .summary-card {
                position: static;
                margin-top: 1.5rem;
            }

            .item-image {
                width: 60px;
                height: 60px;
            }

            .user-info span {
                display: none;
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
        <div class="navbar-right">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Session::get('user.username'), 0, 1)) }}
                </div>
                <span>{{ Session::get('user.username') }}</span>
            </div>
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
                <a href="{{ route('kostumer.keranjang') }}" class="{{ request()->routeIs('kostumer.keranjang', 'kostumer.checkout') ? 'active' : '' }}">
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
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="page-header">
            <h2>
                <i class="fas fa-credit-card"></i>
                Checkout Pesanan
            </h2>
        </div>

        <form action="{{ route('kostumer.order.buat') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Informasi Pengiriman -->
                    <div class="checkout-card">
                        <h5>
                            <i class="fas fa-map-marker-alt"></i>
                            Informasi Pengiriman
                        </h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" value="{{ $user['username'] }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $user['email'] }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" class="form-control" value="{{ $user['phone'] }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Alamat Pengiriman <span class="text-danger">*</span>
                            </label>
                            <textarea name="alamat_pengiriman" class="form-control" rows="3" required
                                placeholder="Masukkan alamat lengkap pengiriman...">{{ old('alamat_pengiriman', $user['alamat']) }}</textarea>
                            @error('alamat_pengiriman')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label">Catatan untuk Penjual (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2"
                                placeholder="Contoh: Harap dikemas dengan bubble wrap...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div class="checkout-card">
                        <h5>
                            <i class="fas fa-box"></i>
                            Ringkasan Pesanan ({{ count($keranjang) }} Item)
                        </h5>

                        @foreach($keranjang as $item)
                        <div class="order-item">
                            <img src="{{ asset($item['image_path']) }}"
                                class="item-image"
                                alt="{{ $item['nama_b'] }}"
                                onerror="this.src='{{ asset('img/no-image.jpg') }}'">
                            <div class="item-details">
                                <h6>{{ $item['nama_b'] }}</h6>
                                <p>
                                    <i class="fas fa-boxes me-1"></i>
                                    {{ $item['quantity'] }} item × Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="item-price">
                                <div class="price-value">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout-card summary-card">
                        <h5>
                            <i class="fas fa-calculator"></i>
                            Ringkasan Pembayaran
                        </h5>

                        <div class="summary-row">
                            <span>Subtotal ({{ count($keranjang) }} item)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="summary-row">
                            <span>Biaya Pengiriman</span>
                            <span class="badge-shipping">
                                <i class="fas fa-truck me-1"></i> GRATIS
                            </span>
                        </div>

                        <div class="summary-row total">
                            <span class="label">Total Pembayaran</span>
                            <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="alert alert-info mt-3 mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Pastikan data pengiriman sudah benar sebelum melakukan pemesanan.</small>
                        </div>

                        <button type="submit" class="btn btn-order w-100 mb-2">
                            <i class="fas fa-check-circle me-2"></i>
                            Buat Pesanan
                        </button>

                        <a href="{{ route('kostumer.keranjang') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const alamat = document.querySelector('[name="alamat_pengiriman"]').value.trim();

            if (!alamat) {
                e.preventDefault();
                alert('⚠️ Alamat pengiriman harus diisi!');
                document.querySelector('[name="alamat_pengiriman"]').focus();
                return false;
            }

            if (alamat.length < 10) {
                e.preventDefault();
                alert('⚠️ Alamat pengiriman terlalu singkat. Mohon masukkan alamat lengkap.');
                document.querySelector('[name="alamat_pengiriman"]').focus();
                return false;
            }

            if (!confirm('🛒 Apakah Anda yakin ingin membuat pesanan ini?\n\nTotal: Rp {{ number_format($total, 0, ', ', '.
                    ') }}')) {
                e.preventDefault();
                return false;
            }
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (alert.querySelector('.btn-close')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
    </script>
</body>

</html>
