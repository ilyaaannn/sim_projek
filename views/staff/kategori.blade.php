<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - SIBIMA+</title>
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

        .content-header {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .add-kategori-box {
            background-color: #D6EAF8;
            border: 2px solid #85C1E9;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            cursor: pointer;
        }

        .btn-simpan {
            background-color: #1B4F72;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-weight: bold;
            float: right;
        }

        .table thead {
            background-color: var(--primary-red);
            color: white;
        }

        .btn-action {
            padding: 0.25rem 0.75rem;
            border-radius: 3px;
            border: none;
            color: white;
            font-size: 0.875rem;
            margin: 0 0.25rem;
        }

        .btn-edit {
            background-color: #3498DB;
        }

        .btn-hapus {
            background-color: var(--primary-red);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-brand">
            <i class="bi bi-lightning-fill"></i> SIBIMA+
        </div>
        <div class="page-title">kategory</div>
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
            <li class="active">
                <i class="bi bi-tag"></i>
                <span>Kategory</span>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <h3 class="mb-4">kategory barang</h3>

            <div class="add-kategori-box">
                <i class="bi bi-plus-circle"></i> <strong>tambah kategory baru</strong>
            </div>

            <form action="{{ route('staff.kategori.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="1"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">status</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif" checked>
                                <label class="form-check-label" for="aktif">aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="tidak_aktif" value="tidak aktif">
                                <label class="form-check-label" for="tidak_aktif">tidak aktif</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-simpan">simpan</button>
                <div class="clearfix"></div>
            </form>

            <div class="mt-4">
                <table id="kategoriTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Kategory</th>
                            <th>status</th>
                            <th>Tanggal dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori ?? [] as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '..' }}</td>
                            <td>
                                <button class="btn-action btn-edit">Edit</button>
                                <button class="btn-action btn-hapus">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategoriTable').DataTable({
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