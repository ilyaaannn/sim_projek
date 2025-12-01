<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-red: #E74C3C;
            --gray-sidebar: #E8E8E8;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background-color: var(--primary-red);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .page-title {
            text-align: center;
            flex-grow: 1;
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
        }

        .btn-logout {
            background-color: white;
            color: black;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .sidebar {
            width: 220px;
            background-color: var(--gray-sidebar);
            min-height: calc(100vh - 70px);
            position: fixed;
            left: 0;
            top: 70px;
            padding: 2rem 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            padding: 1rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #d0d0d0;
        }

        .sidebar-menu li:hover,
        .sidebar-menu li.active {
            background-color: #d0d0d0;
        }

        .sidebar-menu li i {
            font-size: 1.5rem;
        }

        .main-content {
            margin-left: 220px;
            padding: 2rem;
        }

        .stats-card {
            background-color: white;
            border: 2px solid var(--primary-red);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-header {
            background-color: var(--primary-red);
            color: white;
            padding: 0.75rem;
            font-weight: bold;
            margin: -1.5rem -1.5rem 1rem -1.5rem;
            border-radius: 6px 6px 0 0;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 1rem;
        }

        .chart-container {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    @if(!Session::has('user'))
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endif

    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>
        <div class="page-title">Beranda</div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li class="active">
                <i class="bi bi-house-door-fill"></i>
                <span>Beranda</span>
            </li>
            <li onclick="window.location.href='{{ route('staff.tambah-barang') }}'">
                <i class="bi bi-download"></i>
                <span>Tambah Barang</span>
            </li>
            <li onclick="window.location.href='{{ route('staff.data-barang') }}'">
                <i class="bi bi-tv"></i>
                <span>Data Barang</span>
            </li>
            <li onclick="window.location.href='{{ route('staff.stok-barang') }}'">
                <i class="bi bi-archive"></i>
                <span>Stok Barang</span>
            </li>
            <li onclick="window.location.href='{{ route('staff.kategori') }}'">
                <i class="bi bi-tag"></i>
                <span>Kategory</span>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-header">Total Jenis Barang</div>
                    <div class="stats-value">{{ $totalJenisBarang ?? 10 }} Jenis</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-header">Total Stok Barang</div>
                    <div class="stats-value">{{ $totalStokBarang ?? 430 }} Barang</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-header">Total Transaksi</div>
                    <div class="stats-value">{{ $totalTransaksi ?? 10 }} Transaksi</div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="chart-container">
            <h5 class="mb-4">Pemasukan dan Pengeluaran Stok per Bulan</h5>
            <canvas id="stockChart" width="400" height="100"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Data
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ago', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [230, 260, 250, 280, 280, 290, 275, 230, 220, 215],
                    backgroundColor: '#17A2B8',
                }, {
                    label: 'Pengeluaran',
                    data: [215, 230, 230, 245, 260, 255, 255, 240, 250, 235, 220],
                    backgroundColor: '#E74C3C',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 300
                    }
                }
            }
        });
    </script>
</body>

</html>
