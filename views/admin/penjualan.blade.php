<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penjualan - SIBIMA+</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h4 {
            margin: 0;
            color: #2C3E50;
            font-weight: 600;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-section {
            background: #F8F9FA;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .table-responsive {
            margin-top: 20px;
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
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .btn-action {
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .order-id {
            font-weight: 600;
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
            <div>
                <h4><i class="bi bi-cart-check"></i> Kelola Penjualan</h4>
                <small class="text-muted">Manajemen dan monitoring semua transaksi penjualan</small>
            </div>
            <div>
                <span class="badge bg-primary">{{ count($orders) }} Total Order</span>
            </div>
        </div>

        <!-- Content Card -->
        <div class="content-card">
            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="{{ route('admin.penjualan.index') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Status Order</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Dari Tanggal</label>
                            <input type="date" name="dari" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Sampai Tanggal</label>
                            <input type="date" name="sampai" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Kostumer</th>
                            <th>No. Telp</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td><span class="order-id">#{{ $order->id_order }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                                        {{ strtoupper(substr($order->username, 0, 1)) }}
                                    </div>
                                    {{ $order->username }}
                                </div>
                            </td>
                            <td>{{ $order->phone }}</td>
                            <td><strong>Rp {{ number_format($order->totalprice, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($order->status == 'pending')
                                <span class="badge bg-warning status-badge">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                                @elseif($order->status == 'proses')
                                <span class="badge bg-info status-badge">
                                    <i class="bi bi-hourglass-split"></i> Proses
                                </span>
                                @elseif($order->status == 'selesai')
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle"></i> Selesai
                                </span>
                                @else
                                <span class="badge bg-danger status-badge">
                                    <i class="bi bi-x-circle"></i> Batal
                                </span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.penjualan.detail', $order->id_order) }}" class="btn btn-primary btn-sm btn-action">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #CCC;"></i>
                                <p class="text-muted mt-3">Belum ada data penjualan</p>
                            </td>
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