<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order #{{ $order->id_order }} - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #10b981;
            --primary-dark: #059669;
            --light-blue: #f0f9ff;
            --sidebar-width: 280px;
            --navbar-height: 70px;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
        }

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

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary-green);
            transform: scaleY(0);
            transition: transform 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, transparent 100%);
            color: var(--primary-green);
        }

        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            transform: scaleY(1);
        }

        .sidebar-menu i {
            width: 24px;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2rem;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-green);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .card-header-custom i {
            color: var(--primary-green);
            font-size: 1.5rem;
        }

        .card-header-custom h5 {
            margin: 0;
            font-weight: 700;
            color: #1e293b;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 1.25rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .order-item:hover {
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.1);
        }

        .item-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .status-proses {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        .status-selesai {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .status-batal {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row .label {
            color: #64748b;
            font-weight: 500;
        }

        .info-row .value {
            font-weight: 600;
            color: #1e293b;
        }

        .breadcrumb {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .breadcrumb-item a {
            color: var(--primary-green);
            text-decoration: none;
            transition: all 0.3s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .btn-back {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
            color: white;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .price-highlight {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-green), #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .bg-success {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-dark)) !important;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .page-title i {
            color: var(--primary-green);
        }

        .page-title h2 {
            margin: 0;
            font-weight: 800;
            color: #1e293b;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .order-item {
                flex-direction: column;
                text-align: center;
            }

            .item-image {
                margin-bottom: 1rem;
            }
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

        .detail-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .detail-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .detail-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .detail-card:nth-child(3) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="fas fa-bolt"></i> SIBIMA+
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
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
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kostumer.riwayat') }}">Riwayat</a></li>
                <li class="breadcrumb-item active">Order #{{ $order->id_order }}</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="page-title">
                <i class="fas fa-file-invoice fa-2x"></i>
                <h2>Detail Pesanan</h2>
            </div>
            <a href="{{ route('kostumer.riwayat') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Informasi Pesanan -->
                <div class="detail-card">
                    <div class="card-header-custom">
                        <i class="fas fa-info-circle"></i>
                        <h5>Informasi Pesanan</h5>
                    </div>
                    <div class="info-row">
                        <span class="label">Nomor Order</span>
                        <span class="value">#{{ $order->id_order }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Tanggal Order</span>
                        <span class="value">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Status</span>
                        <span>
                            @php
                            $statusClass = 'status-' . $order->status;
                            $statusIcon = [
                            'pending' => 'clock',
                            'proses' => 'spinner',
                            'selesai' => 'check-circle',
                            'batal' => 'times-circle'
                            ];
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fas fa-{{ $statusIcon[$order->status] ?? 'info-circle' }}"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="label">Alamat Pengiriman</span>
                        <span class="value text-end" style="max-width: 60%;">{{ $order->alamat_pengiriman }}</span>
                    </div>
                    @if($order->catatan)
                    <div class="info-row">
                        <span class="label">Catatan</span>
                        <span class="value text-end" style="max-width: 60%;">{{ $order->catatan }}</span>
                    </div>
                    @endif
                </div>

                <!-- Detail Produk -->
                <div class="detail-card">
                    <div class="card-header-custom">
                        <i class="fas fa-box"></i>
                        <h5>Detail Produk</h5>
                    </div>
                    @foreach($orderItems as $item)
                    <div class="order-item">
                        <img src="{{ asset($item->image_path) }}" class="item-image me-3" alt="{{ $item->nama_b }}"
                            onerror="this.src='https://via.placeholder.com/90x90?text=No+Image'">
                        <div class="flex-grow-1">
                            <h6 class="mb-2 fw-bold">{{ $item->nama_b }}</h6>
                            <span class="badge bg-success mb-2">{{ $item->nama_kategori }}</span>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-box"></i> {{ $item->kuantiti }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-end">
                            <p class="price-highlight mb-0">
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Ringkasan Pembayaran -->
                <div class="detail-card" style="position: sticky; top: 100px;">
                    <div class="card-header-custom">
                        <i class="fas fa-calculator"></i>
                        <h5>Ringkasan Pembayaran</h5>
                    </div>
                    <div class="info-row">
                        <span class="label">Subtotal</span>
                        <span class="value">Rp {{ number_format($order->totalprice, 0, ',', '.') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Biaya Pengiriman</span>
                        <span class="value text-success">GRATIS</span>
                    </div>
                    <hr style="border-top: 2px solid var(--primary-green);">
                    <div class="info-row">
                        <h6 class="mb-0">Total Pembayaran</h6>
                        <h5 class="price-highlight mb-0">Rp {{ number_format($order->totalprice, 0, ',', '.') }}</h5>
                    </div>

                    @if($order->status == 'pending')
                    <div class="alert alert-warning mt-3 mb-0 small">
                        <i class="fas fa-clock"></i> Pesanan Anda sedang menunggu konfirmasi
                    </div>
                    @elseif($order->status == 'proses')
                    <div class="alert alert-info mt-3 mb-0 small">
                        <i class="fas fa-box"></i> Pesanan Anda sedang diproses
                    </div>
                    @elseif($order->status == 'selesai')
                    <div class="alert alert-success mt-3 mb-0 small">
                        <i class="fas fa-check-circle"></i> Pesanan telah selesai
                    </div>
                    @else
                    <div class="alert alert-danger mt-3 mb-0 small">
                        <i class="fas fa-times-circle"></i> Pesanan telah dibatalkan
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>