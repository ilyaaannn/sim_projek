<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50C878;
            --danger-color: #E74C3C;
            --warning-color: #F39C12;
            --sidebar-bg: #2C3E50;
            --sidebar-hover: #34495E;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F5F7FA;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: var(--sidebar-bg);
            padding-top: 20px;
            z-index: 1000;
            overflow-y: auto;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 800;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .navbar-brand i {
            font-size: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .sidebar .menu-item {
            padding: 15px 20px;
            color: #ECF0F1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar .menu-item:hover,
        .sidebar .menu-item.active {
            background: var(--sidebar-hover);
            border-left-color: var(--primary-color);
            color: white;
        }

        .sidebar .menu-item i {
            font-size: 1.2rem;
            width: 25px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #F0F0F0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #7F8C8D;
            font-weight: 500;
        }

        .info-value {
            color: #2C3E50;
            font-weight: 600;
        }

        .product-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #F8F9FA;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            flex: 1;
        }

        .status-update-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
        }

        .btn-status {
            padding: 10px 20px;
            border-radius: 10px;
            border: 2px solid white;
            background: transparent;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-status:hover {
            background: white;
            color: #667eea;
        }

        .total-section {
            background: #F8F9FA;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .total-row.grand {
            border-top: 2px solid #dee2e6;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('admin.penjualan.index') }}" class="menu-item active">
            <i class="bi bi-cart-check"></i>
            <span>Kelola Penjualan</span>
        </a>

        <a href="{{ route('admin.barang.index') }}" class="menu-item">
            <i class="bi bi-box-seam"></i>
            <span>Kelola Barang</span>
        </a>

        <a href="{{ route('admin.stok.index') }}" class="menu-item">
            <i class="bi bi-stack"></i>
            <span>Lihat Stok</span>
        </a>

        <a href="{{ route('admin.transaksi.index') }}" class="menu-item">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transaksi Barang</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="menu-item">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Laporan Penjualan</span>
        </a>

        <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Log-out</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4><i class="bi bi-receipt"></i> Detail Penjualan #{{ $order->id_order }}</h4>
                    <small class="text-muted">Informasi lengkap transaksi penjualan</small>
                </div>
                <a href="{{ route('admin.penjualan.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Informasi Kostumer -->
                <div class="content-card">
                    <h5 class="mb-4"><i class="bi bi-person-circle"></i> Informasi Kostumer</h5>
                    <div class="info-row">
                        <span class="info-label">Nama Kostumer</span>
                        <span class="info-value">{{ $order->username }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $order->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">No. Telepon</span>
                        <span class="info-value">{{ $order->phone }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat Pengiriman</span>
                        <span class="info-value">{{ $order->alamat_pengiriman }}</span>
                    </div>
                    @if($order->catatan)
                    <div class="info-row">
                        <span class="info-label">Catatan</span>
                        <span class="info-value">{{ $order->catatan }}</span>
                    </div>
                    @endif
                </div>

                <!-- Daftar Produk -->
                <div class="content-card">
                    <h5 class="mb-4"><i class="bi bi-box-seam"></i> Daftar Produk</h5>
                    @foreach($orderItems as $item)
                    <div class="product-item">
                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->nama_b }}" class="product-img" onerror="this.src='https://via.placeholder.com/80'">
                        <div class="product-info">
                            <h6 class="mb-1">{{ $item->nama_b }}</h6>
                            <p class="mb-1 text-muted">Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->kuantiti }}</p>
                            <strong class="text-primary">Subtotal: Rp {{ number_format($item->total, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    @endforeach

                    <div class="total-section">
                        <div class="total-row grand">
                            <span>TOTAL PEMBAYARAN</span>
                            <span>Rp {{ number_format($order->totalprice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Status Order -->
                <div class="content-card">
                    <h5 class="mb-3"><i class="bi bi-info-circle"></i> Status Order</h5>
                    <div class="info-row">
                        <span class="info-label">Tanggal Order</span>
                        <span class="info-value">{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status Saat Ini</span>
                        <span class="info-value">
                            @if($order->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($order->status == 'proses')
                            <span class="badge bg-info">Proses</span>
                            @elseif($order->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                            @else
                            <span class="badge bg-danger">Batal</span>
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="status-update-card mt-3">
                    <h5 class="mb-3"><i class="bi bi-arrow-repeat"></i> Update Status</h5>
                    <form action="{{ route('admin.penjualan.update_status', $order->id_order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-status w-100">
                            <i class="bi bi-check-circle"></i> Update Status
                        </button>
                    </form>
                </div>

                <!-- Quick Actions -->
                <div class="content-card mt-3">
                    <h6 class="mb-3">Aksi Cepat</h6>
                    <button class="btn btn-outline-primary w-100 mb-2" onclick="window.print()">
                        <i class="bi bi-printer"></i> Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @if(session('success'))
    <script>
        alert('{{ session("success") }}');
    </script>
    @endif
</body>

</html>