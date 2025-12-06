<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #00ff00;
            --light-blue: #e3f2fd;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-green) 0%, #00cc00 100%);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--light-blue);
            padding-top: 80px;
            z-index: 100;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: white;
            border-left: 4px solid var(--primary-green);
            padding-left: calc(1.5rem - 4px);
        }

        .sidebar-menu i {
            width: 30px;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            padding-top: 80px;
        }

        .checkout-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .btn-order {
            background: var(--primary-green);
            border: none;
            color: white;
            padding: 12px;
            font-size: 1.1rem;
        }

        .btn-order:hover {
            background: #00cc00;
            color: white;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
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
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <h2 class="mb-4 fw-bold"><i class="fas fa-credit-card"></i> Checkout</h2>

        <form action="{{ route('kostumer.order.buat') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Informasi Pengiriman -->
                    <div class="checkout-card">
                        <h5 class="mb-3 fw-bold"><i class="fas fa-map-marker-alt"></i> Informasi Pengiriman</h5>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" value="{{ $user['username'] }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user['email'] }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" value="{{ $user['phone'] }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman <span class="text-danger">*</span></label>
                            <textarea name="alamat_pengiriman" class="form-control" rows="3" required
                                placeholder="Masukkan alamat lengkap pengiriman...">{{ $user['alamat'] }}</textarea>
                            @error('alamat_pengiriman')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2"
                                placeholder="Catatan untuk penjual..."></textarea>
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div class="checkout-card">
                        <h5 class="mb-3 fw-bold"><i class="fas fa-box"></i> Ringkasan Pesanan</h5>
                        <hr>
                        @foreach($keranjang as $item)
                        <div class="order-item">
                            <img src="{{ asset($item['image_path']) }}" class="item-image me-3" alt="{{ $item['nama_b'] }}"
                                onerror="this.src='https://via.placeholder.com/60x60?text=No+Image'">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $item['nama_b'] }}</h6>
                                <p class="text-muted small mb-0">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="text-end">
                                <p class="fw-bold text-success mb-0">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="checkout-card" style="position: sticky; top: 100px;">
                        <h5 class="mb-3 fw-bold">Total Pembayaran</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ count($keranjang) }} item)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success">GRATIS</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="mb-0">Total</h6>
                            <h5 class="text-success mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                        </div>

                        <div class="alert alert-info small mb-3">
                            <i class="fas fa-info-circle"></i> Pastikan data pengiriman sudah benar sebelum melakukan pemesanan
                        </div>

                        <button type="submit" class="btn btn-order w-100 mb-2">
                            <i class="fas fa-check-circle"></i> Buat Pesanan
                        </button>
                        <a href="{{ route('kostumer.keranjang') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
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
                alert('Alamat pengiriman harus diisi!');
                return false;
            }

            if (!confirm('Apakah Anda yakin ingin membuat pesanan ini?')) {
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>

</html>