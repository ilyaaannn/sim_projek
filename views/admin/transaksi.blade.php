<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Barang - SIBIMA+</title>
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

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .form-transaksi {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-transaksi .form-label {
            color: white;
            font-weight: 600;
        }

        .form-transaksi .form-control,
        .form-transaksi .form-select {
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-transaksi .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-transaksi .form-control:focus,
        .form-transaksi .form-select:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: white;
            color: white;
        }

        .form-transaksi .form-select option {
            color: #2C3E50;
        }

        .btn-submit-transaksi {
            background: white;
            color: #667eea;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-submit-transaksi:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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

        .tipe-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .tipe-badge.masuk {
            background: rgba(80, 200, 120, 0.1);
            color: var(--secondary-color);
        }

        .tipe-badge.keluar {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .stok-change {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stok-arrow {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .stok-arrow.up {
            color: var(--secondary-color);
        }

        .stok-arrow.down {
            color: var(--danger-color);
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

        <a href="{{ route('admin.transaksi.index') }}" class="menu-item active">
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
                <h4><i class="bi bi-arrow-left-right"></i> Transaksi Barang</h4>
                <small class="text-muted">Input stok masuk dan keluar barang</small>
            </div>
        </div>

        <!-- Form Transaksi -->
        <div class="form-transaksi">
            <h5 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Transaksi Baru</h5>
            <form action="{{ route('admin.transaksi.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Pilih Barang <span class="text-warning">*</span></label>
                        <select name="id_barang" class="form-select" required id="selectBarang">
                            <option value="">-- Pilih Barang --</option>
                            @php
                            $barangList = DB::table('tbl_barang')->where('status', 'active')->get();
                            @endphp
                            @foreach($barangList as $b)
                            <option value="{{ $b->id_barang }}" data-stok="{{ $b->stok_b }}">
                                {{ $b->nama_b }} (Stok: {{ $b->stok_b }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Tipe <span class="text-warning">*</span></label>
                        <select name="tipe" class="form-select" required>
                            <option value="masuk">Stok Masuk</option>
                            <option value="keluar">Stok Keluar</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Jumlah <span class="text-warning">*</span></label>
                        <input type="number" name="kuantiti" class="form-control" min="1" required placeholder="0">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Keterangan <span class="text-warning">*</span></label>
                        <input type="text" name="desc_tb" class="form-control" required placeholder="Deskripsi transaksi">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-submit-transaksi w-100">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Riwayat Transaksi -->
        <div class="content-card">
            <h5 class="mb-4"><i class="bi bi-clock-history"></i> Riwayat Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Perubahan Stok</th>
                            <th>Keterangan</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $t)
                        <tr>
                            <td><strong>#{{ $t->id_transb }}</strong></td>
                            <td>{{ date('d/m/Y H:i', strtotime($t->created_at)) }}</td>
                            <td>{{ $t->nama_b }}</td>
                            <td>
                                @if($t->tipe == 'masuk')
                                <span class="tipe-badge masuk">
                                    <i class="bi bi-arrow-down-circle"></i> Masuk
                                </span>
                                @else
                                <span class="tipe-badge keluar">
                                    <i class="bi bi-arrow-up-circle"></i> Keluar
                                </span>
                                @endif
                            </td>
                            <td><strong>{{ $t->kuantiti }}</strong></td>
                            <td>
                                <div class="stok-change">
                                    <span class="badge bg-secondary">{{ $t->stok_sebelum }}</span>
                                    <span class="stok-arrow {{ $t->tipe == 'masuk' ? 'up' : 'down' }}">
                                        {{ $t->tipe == 'masuk' ? '↑' : '↓' }}
                                    </span>
                                    <span class="badge {{ $t->tipe == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $t->stok_sesudah }}
                                    </span>
                                </div>
                            </td>
                            <td>{{ $t->desc_tb }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">
                                        {{ strtoupper(substr($t->username, 0, 1)) }}
                                    </div>
                                    <small>{{ $t->username }}</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #CCC;"></i>
                                <p class="text-muted mt-3">Belum ada transaksi</p>
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

    @if(session('error'))
    <script>
        alert('{{ session("error") }}');
    </script>
    @endif
</body>

</html>