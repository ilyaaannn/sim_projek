<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - SIBIMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if(!Session::has('user'))
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endif

    <nav class="navbar navbar-dark bg-warning">
        <div class="container-fluid">
            <span class="navbar-brand text-dark">Dashboard Staff - SIBIMA</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Selamat Datang, {{ Session::get('user.username') }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ Session::get('user.email') }}</p>
                <p><strong>Level:</strong> {{ Session::get('user.level') }}</p>
                <hr>
                <h6>Menu Inventory:</h6>
                <ul>
                    <li>Data Barang</li>
                    <li>Stok Barang</li>
                    <li>Kelola Gudang</li>
                    <li>Laporan Stok</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>