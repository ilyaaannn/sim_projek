<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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

        .form-section {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .btn-input {
            background-color: var(--primary-red);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-input:hover {
            background-color: #C0392B;
        }

        .table-container {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: var(--primary-red);
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>
        <div class="page-title">tambah barang</div>
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
            <li onclick="window.location.href='{{ route('dashboard') }}'">
                <i class="bi bi-house-door-fill"></i>
                <span>Beranda</span>
            </li>
            <li class="active">
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
        <!-- Form Section -->
        <div class="form-section">
            <form action="{{ route('staff.tambah-barang.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <option value="">Pilih Barang</option>
                            @foreach($barangList ?? [] as $brg)
                            <option value="{{ $brg->id_barang }}">{{ $brg->nama_b }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jumlah</label>
                        <input type="number" name="kuantiti" class="form-control" placeholder="Jumlah" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenis</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipe" id="masuk" value="masuk" required>
                                <label class="form-check-label" for="masuk">Masuk</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipe" id="keluar" value="keluar">
                                <label class="form-check-label" for="keluar">Keluar</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Keterangan</label>
                        <input type="text" name="desc_tb" class="form-control" placeholder="Keterangan">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn-input">
                        <i class="bi bi-plus-circle"></i> Input Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <table id="barangTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi ?? [] as $item)
                    <tr>
                        <td>{{ $item->nama_b }}</td>
                        <td>{{ $item->kuantiti }}</td>
                        <td>{{ ucfirst($item->tipe) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#barangTable').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "Serch :",
                    "lengthMenu": "Show _MENU_ Entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entires",
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                }
            });
        });
    </script>
</body>

</html>