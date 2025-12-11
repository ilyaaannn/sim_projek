<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - SIBIMA+</title>
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

        .summary-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .summary-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .summary-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .filter-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
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

        .table tfoot {
            background: #F8F9FA;
            font-weight: bold;
        }

        .table tfoot td {
            padding: 15px;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-export {
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .stats-mini {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-mini-card {
            background: #F8F9FA;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid;
        }

        .stat-mini-card.pending {
            border-left-color: var(--warning-color);
        }

        .stat-mini-card.proses {
            border-left-color: var(--primary-color);
        }

        .stat-mini-card.selesai {
            border-left-color: var(--secondary-color);
        }

        .stat-mini-card.batal {
            border-left-color: var(--danger-color);
        }

        .stat-mini-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2C3E50;
        }

        .stat-mini-label {
            color: #7F8C8D;
            font-size: 0.9rem;
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

        <a href="{{ route('admin.stok.index') }}" class="menu-item">
            <i class="bi bi-stack"></i>
            <span>Lihat Stok</span>
        </a>

        <a href="{{ route('admin.transaksi.index') }}" class="menu-item">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transaksi Barang</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="menu-item active">
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
            <h4><i class="bi bi-file-earmark-bar-graph"></i> Laporan Penjualan</h4>
            <small class="text-muted">Analisis dan rekap transaksi penjualan</small>
        </div>

        <!-- Summary Card -->
        <div class="summary-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="summary-label">
                        <i class="bi bi-cash-stack"></i> Total Pendapatan (Selesai)
                    </div>
                    <div class="summary-value">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>
                    <small>Dari {{ count($laporan) }} transaksi</small>
                </div>
                <div class="col-md-4 text-end">
                    <div class="export-buttons">
                        <a href="{{ route('admin.laporan.pdf') }}?{{ http_build_query(request()->all()) }}" class="btn btn-light btn-export" target="_blank">
                            <i class="bi bi-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mini Stats -->
        <div class="stats-mini">
            <div class="stat-mini-card pending">
                <div class="stat-mini-value">{{ $laporan->where('status', 'pending')->count() }}</div>
                <div class="stat-mini-label">Pending</div>
            </div>
            <div class="stat-mini-card proses">
                <div class="stat-mini-value">{{ $laporan->where('status', 'proses')->count() }}</div>
                <div class="stat-mini-label">Proses</div>
            </div>
            <div class="stat-mini-card selesai">
                <div class="stat-mini-value">{{ $laporan->where('status', 'selesai')->count() }}</div>
                <div class="stat-mini-label">Selesai</div>
            </div>
            <div class="stat-mini-card batal">
                <div class="stat-mini-value">{{ $laporan->where('status', 'batal')->count() }}</div>
                <div class="stat-mini-label">Batal</div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <h6 class="mb-3"><i class="bi bi-funnel"></i> Filter Laporan</h6>
            <form method="GET" action="{{ route('admin.laporan.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Content Card -->
        <div class="content-card">
            <h5 class="mb-4"><i class="bi bi-table"></i> Data Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Order</th>
                            <th>Tanggal</th>
                            <th>Kostumer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>#{{ $item->id_order }}</strong></td>
                            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                            <td>{{ $item->username }}</td>
                            <td><strong>Rp {{ number_format($item->totalprice, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($item->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif($item->status == 'proses')
                                <span class="badge bg-info">Proses</span>
                                @elseif($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                                @else
                                <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #CCC;"></i>
                                <p class="text-muted mt-3">Tidak ada data untuk filter ini</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if(count($laporan) > 0)
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end">TOTAL PENDAPATAN (SELESAI):</td>
                            <td colspan="2">
                                <span style="color: var(--primary-color); font-size: 1.2rem;">
                                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>