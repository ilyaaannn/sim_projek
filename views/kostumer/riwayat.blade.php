<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - SIBIMA+</title>
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
            padding: 2rem;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* Order Card Styling */
        .order-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border-left: 4px solid var(--primary-green);
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h4 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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

        /* Button Styling */
        .btn-detail {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-pdf {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }

        .btn-pdf:disabled {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid var(--primary-green);
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        .page-header i {
            color: var(--primary-green);
        }

        /* Order Info Grid */
        .order-info {
            display: grid;
            gap: 0.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .info-item i {
            color: var(--primary-green);
            width: 20px;
        }

        .order-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .order-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .order-title h5 {
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .order-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .navbar-custom {
                padding: 0 1rem;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .order-card {
                padding: 1rem;
            }

            .order-actions {
                width: 100%;
                flex-direction: column;
            }

            .btn-detail,
            .btn-pdf {
                width: 100%;
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

        .order-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .order-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .order-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .order-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .order-card:nth-child(4) {
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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="page-header">
            <i class="fas fa-history fa-2x"></i>
            <h2>Riwayat Pesanan</h2>
        </div>

        @if($orders->count() == 0)
        <div class="order-card">
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h4>Belum Ada Pesanan</h4>
                <p class="text-muted">Anda belum pernah melakukan pemesanan</p>
                <a href="{{ route('kostumer.produk') }}" class="btn btn-detail mt-3">
                    <i class="fas fa-shopping-bag"></i> Mulai Belanja
                </a>
            </div>
        </div>
        @else
        <div class="row">
            @foreach($orders as $order)
            <div class="col-12">
                <div class="order-card">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="order-header">
                                <div class="order-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="order-title">
                                    <h5>Order #{{ $order->id_order }}</h5>
                                </div>
                                <div class="ms-auto">
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
                                </div>
                            </div>
                            <div class="order-info">
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ Str::limit($order->alamat_pengiriman, 60) }}</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span class="fw-bold text-success">Rp {{ number_format($order->totalprice, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="order-actions">
                                <a href="{{ route('kostumer.riwayat.detail', $order->id_order) }}" class="btn btn-detail">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                @php
                                $orderDate = \Carbon\Carbon::parse($order->created_at);
                                $daysSinceOrder = $orderDate->diffInDays(\Carbon\Carbon::now());
                                $canDownloadPDF = $daysSinceOrder <= 7;
                                    @endphp
                                    <button
                                    class="btn btn-pdf"
                                    @if($canDownloadPDF)
                                    onclick="window.location.href='{{ route('kostumer.riwayat.pdf', $order->id_order) }}'"
                                    @else
                                    disabled
                                    title="PDF hanya tersedia untuk pesanan 7 hari terakhir"
                                    @endif>
                                    <i class="fas fa-file-pdf"></i>
                                    @if($canDownloadPDF)
                                    Cetak PDF
                                    @else
                                    PDF Tidak Tersedia
                                    @endif
                                    </button>
                            </div>
                            @if(!$canDownloadPDF)
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i> PDF hanya untuk 7 hari terakhir
                            </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>