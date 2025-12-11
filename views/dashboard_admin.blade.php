<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIBIMA+</title>
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

        /* Sidebar */
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

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Header */
        .top-header {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .date-badge {
            background: #F8F9FA;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #6C757D;
        }

        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-card.blue {
            border-left-color: var(--primary-color);
        }

        .stats-card.green {
            border-left-color: var(--secondary-color);
        }

        .stats-card.orange {
            border-left-color: var(--warning-color);
        }

        .stats-card.red {
            border-left-color: var(--danger-color);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .stats-icon.blue {
            background: rgba(74, 144, 226, 0.1);
            color: var(--primary-color);
        }

        .stats-icon.green {
            background: rgba(80, 200, 120, 0.1);
            color: var(--secondary-color);
        }

        .stats-icon.orange {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }

        .stats-icon.red {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .stats-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2C3E50;
            margin: 10px 0;
        }

        .stats-label {
            color: #7F8C8D;
            font-size: 0.95rem;
        }

        /* Tables */
        .data-table {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
        }

        .data-table h5 {
            margin-bottom: 20px;
            color: #2C3E50;
            font-weight: 600;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: #F8F9FA;
        }

        .table thead th {
            border: none;
            color: #6C757D;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 30px;
            justify-content: center;
            margin-top: 30px;
        }

        .action-btn {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            text-decoration: none;
            color: #2C3E50;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            flex: 1;
            max-width: 300px;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            color: var(--primary-color);
        }

        .action-btn i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .action-btn h6 {
            margin: 0;
            font-weight: 600;
        }

        /* Logout Button */
        .btn-logout {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: #C0392B;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    @if(!Session::has('user'))
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>

        <a href="{{ route('dashboard') }}" class="menu-item active">
            <i class="bi bi-house-door"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('admin.penjualan.index') }}" class="menu-item">
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
        <!-- Header -->
        <div class="top-header">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Session::get('user.username'), 0, 1)) }}
                </div>
                <div>
                    <h5 class="mb-1">Selamat Datang, {{ Session::get('user.username') }}</h5>
                    <small class="text-muted">{{ Session::get('user.email') }}</small>
                </div>
            </div>
            <div class="date-badge">
                <i class="bi bi-calendar3"></i> {{ date('d F Y') }}
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stats-card blue">
                    <div class="stats-icon blue">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="stats-value">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                    <div class="stats-label">Total Penjualan</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stats-card green">
                    <div class="stats-icon green">
                        <i class="bi bi-cart-check"></i>
                    </div>
                    <div class="stats-value">{{ $totalOrder }}</div>
                    <div class="stats-label">Total Order</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stats-card orange">
                    <div class="stats-icon orange">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stats-value">{{ $totalBarang }}</div>
                    <div class="stats-label">Produk Aktif</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stats-card red">
                    <div class="stats-icon red">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stats-value">{{ $totalKostumer }}</div>
                    <div class="stats-label">Total Kostumer</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="action-buttons">
            <a href="{{ route('admin.penjualan.index') }}" class="action-btn">
                <i class="bi bi-cart-plus" style="color: var(--primary-color);"></i>
                <h6>Kelola Penjualan</h6>
            </a>

            <a href="{{ route('admin.transaksi.index') }}" class="action-btn">
                <i class="bi bi-arrow-repeat" style="color: var(--secondary-color);"></i>
                <h6>Tambah Transaksi</h6>
            </a>

            <a href="{{ route('admin.laporan.index') }}" class="action-btn">
                <i class="bi bi-file-text" style="color: var(--warning-color);"></i>
                <h6>Lihat Laporan</h6>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="data-table">
            <h5><i class="bi bi-clock-history"></i> Order Terbaru</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Nama Kostumer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><strong>#{{ $order->id_order }}</strong></td>
                            <td>{{ $order->username }}</td>
                            <td>Rp {{ number_format($order->totalprice, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif($order->status == 'proses')
                                <span class="badge bg-info">Proses</span>
                                @elseif($order->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                                @else
                                <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.penjualan.detail', $order->id_order) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada order</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Products -->
        <div class="data-table">
            <h5><i class="bi bi-star"></i> Produk Terlaris</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $product)
                        <tr>
                            <td>{{ $product->nama_b }}</td>
                            <td><span class="badge bg-success">{{ $product->total_terjual }} item</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
