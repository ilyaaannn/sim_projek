<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang - SIBIMA+</title>
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
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .stok-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Image Preview Styles */
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            display: none;
        }

        .image-preview.show {
            display: block;
        }

        .current-image-container {
            margin-top: 10px;
            text-align: center;
        }

        .current-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }

        .image-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 0.85rem;
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

        <a href="{{ route('admin.barang.index') }}" class="menu-item active">
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
                <h4><i class="bi bi-box-seam"></i> Kelola Barang</h4>
                <small class="text-muted">Manajemen data produk UMKM Bengkalis</small>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle"></i> Tambah Barang
            </button>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Content Card -->
        <div class="content-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->image_path) }}"
                                    alt="{{ $item->nama_b }}"
                                    class="product-img-thumb"
                                    onerror="this.src='{{ asset('img/no-image.jpg') }}'">
                            </td>
                            <td>
                                <strong>{{ $item->nama_b }}</strong>
                                <br><small class="text-muted">{{ Str::limit($item->desc_b, 50) }}</small>
                            </td>
                            <td><span class="badge bg-info">{{ $item->nama_kategori }}</span></td>
                            <td><strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($item->stok_b < 10)
                                    <span class="stok-badge bg-danger text-white">{{ $item->stok_b }}</span>
                                    @elseif($item->stok_b < 30)
                                        <span class="stok-badge bg-warning text-dark">{{ $item->stok_b }}</span>
                                        @else
                                        <span class="stok-badge bg-success text-white">{{ $item->stok_b }}</span>
                                        @endif
                            </td>
                            <td>
                                @if($item->status == 'active')
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-action" onclick="editBarang({{ json_encode($item) }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-action" onclick="hapusBarang({{ $item->id_barang }}, '{{ $item->nama_b }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #CCC;"></i>
                                <p class="text-muted mt-3">Belum ada data barang</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Tambah Barang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_b" class="form-control @error('nama_b') is-invalid @enderror"
                                    value="{{ old('nama_b') }}" required>
                                @error('nama_b')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" min="0" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok_b" class="form-control @error('stok_b') is-invalid @enderror"
                                    value="{{ old('stok_b') }}" min="0" required>
                                @error('stok_b')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Gambar Barang</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" accept="image/*" onchange="previewImage(event, 'preview-add')">
                                <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin upload gambar.</small>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="preview-add" class="image-preview" alt="Preview">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="desc_b" class="form-control @error('desc_b') is-invalid @enderror"
                                    rows="3">{{ old('desc_b') }}</textarea>
                                @error('desc_b')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Barang</label>
                                <input type="text" name="nama_b" id="edit_nama_b" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="id_kategori" id="edit_id_kategori" class="form-select" required>
                                    @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga</label>
                                <input type="number" name="price" id="edit_price" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok</label>
                                <input type="number" name="stok_b" id="edit_stok_b" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Gambar Barang</label>
                                <div class="current-image-container" id="current-image-container">
                                    <p class="text-muted mb-2">Gambar saat ini:</p>
                                    <img id="edit_current_image" class="current-image" alt="Current Image">
                                </div>
                                <input type="file" class="form-control mt-2"
                                    name="image" accept="image/*" onchange="previewImage(event, 'preview-edit')">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                <img id="preview-edit" class="image-preview" alt="Preview">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="desc_b" id="edit_desc_b" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form Hapus -->
    <form id="formHapus" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Preview image function
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('show');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.remove('show');
            }
        }

        // Edit barang function
        function editBarang(data) {
            document.getElementById('edit_nama_b').value = data.nama_b;
            document.getElementById('edit_id_kategori').value = data.id_kategori;
            document.getElementById('edit_price').value = data.price;
            document.getElementById('edit_stok_b').value = data.stok_b;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_desc_b').value = data.desc_b || '';

            // Show current image
            const currentImageContainer = document.getElementById('current-image-container');
            const currentImage = document.getElementById('edit_current_image');
            if (data.image_path) {
                currentImage.src = '{{ asset("") }}' + data.image_path;
                currentImage.onerror = function() {
                    this.src = '{{ asset("img/no-image.jpg") }}';
                };
                currentImageContainer.style.display = 'block';
            } else {
                currentImageContainer.style.display = 'none';
            }

            // Reset preview
            document.getElementById('preview-edit').src = '';
            document.getElementById('preview-edit').classList.remove('show');

            document.getElementById('formEdit').action = '{{ route("admin.barang.update", ":id") }}'.replace(':id', data.id_barang);

            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        }

        // Hapus barang function
        function hapusBarang(id, nama) {
            if (confirm('Yakin ingin menghapus barang "' + nama + '"?\n\nData yang dihapus tidak dapat dikembalikan!')) {
                const form = document.getElementById('formHapus');
                form.action = '{{ route("admin.barang.destroy", ":id") }}'.replace(':id', id);
                form.submit();
            }
        }

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>

</html>