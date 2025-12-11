<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Stok - SIBIMA+</title>
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

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .stat-icon.warning {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }

        .stat-icon.success {
            background: rgba(80, 200, 120, 0.1);
            color: var(--secondary-color);
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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

        .product-img-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }

        .stok-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stok-bar {
            flex: 1;
            height: 8px;
            background: #E0E0E0;
            border-radius: 10px;
            overflow: hidden;
        }

        .stok-bar-fill {
            height: 100%;
            transition: width 0.3s;
        }

        .stok-bar-fill.danger {
            background: var(--danger-color);
        }

        .stok-bar-fill.warning {
            background: var(--warning-color);
        }

        .stok-bar-fill.success {
            background: var(--secondary-color);
        }

        .stok-label {
            font-weight: bold;
            min-width: 60px;
            text-align: center;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .stok-label.danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .stok-label.warning {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }

        .stok-label.success {
            background: rgba(80, 200, 120, 0.1);
            color: var(--secondary-color);
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-tab {
            padding: 10px 20px;
            border: 2px solid #E0E0E0;
            border-radius: 25px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .filter-tab:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .filter-tab.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
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

        <a href="{{ route('admin.penjualan.index') }}" class="menu-item">
            <i class="bi bi-cart-check"></i>
            <span>Kelola Penjualan</span>
        </a>

        <a href="{{ route('admin.barang.index') }}" class="menu-item">
            <i class="bi bi-box-seam"></i>
            <span>Kelola Barang</span>
        </a>

        <a href="{{ route('admin.stok.index') }}" class="menu-item active">
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
            <h4><i class="bi bi-stack"></i> Monitoring Stok Barang</h4>
            <small class="text-muted">Pantau ketersediaan stok produk UMKM Bengkalis</small>
        </div>

        <!-- Stats Cards -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon danger">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div class="text-muted small">Stok Kritis</div>
                    <h4 class="mb-0">{{ $stok->where('stok_b', '<', 10)->count() }}</h4>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
                <div>
                    <div class="text-muted small">Stok Rendah</div>
                    <h4 class="mb-0">{{ $stok->whereBetween('stok_b', [10, 29])->count() }}</h4>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="text-muted small">Stok Aman</div>
                    <h4 class="mb-0">{{ $stok->where('stok_b', '>=', 30)->count() }}</h4>
                </div>
            </div>
        </div>

        <!-- Content Card -->
        <div class="content-card">
            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <div class="filter-tab active" onclick="filterStok('all')">
                    <i class="bi bi-grid"></i> Semua
                </div>
                <div class="filter-tab" onclick="filterStok('kritis')">
                    <i class="bi bi-exclamation-triangle"></i> Kritis
                </div>
                <div class="filter-tab" onclick="filterStok('rendah')">
                    <i class="bi bi-exclamation-circle"></i> Rendah
                </div>
                <div class="filter-tab" onclick="filterStok('aman')">
                    <i class="bi bi-check-circle"></i> Aman
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="tabelStok">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok Tersedia</th>
                            <th>Status</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stok as $item)
                        <tr data-stok="{{ $item->stok_b }}">
                            <td>
                                <img src="{{ asset($item->image_path) }}" alt="{{ $item->nama_b }}" class="product-img-thumb" onerror="this.src='https://via.placeholder.com/50'">
                            </td>
                            <td>
                                <strong>{{ $item->nama_b }}</strong>
                            </td>
                            <td><span class="badge bg-info">{{ $item->nama_kategori }}</span></td>
                            <td>
                                <div class="stok-indicator">
                                    <div class="stok-bar">
                                        @php
                                        $percentage = min(100, ($item->stok_b / 100) * 100);
                                        $statusClass = $item->stok_b < 10 ? 'danger' : ($item->stok_b < 30 ? 'warning' : 'success' );
                                                @endphp
                                                <div class="stok-bar-fill {{ $statusClass }}" style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                                <span class="stok-label {{ $statusClass }}">{{ $item->stok_b }}</span>
            </div>
            </td>
            <td>
                @if($item->stok_b < 10)
                    <span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> Kritis</span>
                    @elseif($item->stok_b < 30)
                        <span class="badge bg-warning"><i class="bi bi-exclamation-circle"></i> Rendah</span>
                        @else
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aman</span>
                        @endif
            </td>
            <td><strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #CCC;"></i>
                    <p class="text-muted mt-3">Belum ada data stok</p>
                </td>
            </tr>
            @endforelse
            </tbody>
            </table>
        </div>

        <div class="mt-4 p-3 bg-light rounded">
            <h6 class="mb-3"><i class="bi bi-info-circle"></i> Keterangan Status Stok:</h6>
            <div class="row">
                <div class="col-md-4">
                    <span class="badge bg-danger me-2">Kritis</span> Stok kurang dari 10 unit
                </div>
                <div class="col-md-4">
                    <span class="badge bg-warning me-2">Rendah</span> Stok 10-29 unit
                </div>
                <div class="col-md-4">
                    <span class="badge bg-success me-2">Aman</span> Stok 30 unit atau lebih
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function filterStok(type) {
            const rows = document.querySelectorAll('#tabelStok tbody tr');
            const tabs = document.querySelectorAll('.filter-tab');

            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.closest('.filter-tab').classList.add('active');

            rows.forEach(row => {
                const stok = parseInt(row.dataset.stok);
                let show = false;

                switch (type) {
                    case 'all':
                        show = true;
                        break;
                    case 'kritis':
                        show = stok < 10;
                        break;
                    case 'rendah':
                        show = stok >= 10 && stok < 30;
                        break;
                    case 'aman':
                        show = stok >= 30;
                        break;
                }

                row.style.display = show ? '' : 'none';
            });
        }
    </script>
</body>

</html>