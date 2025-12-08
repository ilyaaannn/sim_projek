{{-- views/staff/data_barang_staff.blade.php --}}
@extends('staff.layouts')

@section('page-title', 'Data Barang')

@section('content')
{{-- Tambahkan di bagian paling atas setelah @section --}}
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<style>
    .content-header {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(229, 57, 53, 0.3);
    }

    .content-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .content-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .card-header {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 1.25rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(229, 57, 53, 0.4);
    }

    .btn-warning {
        background: linear-gradient(135deg, #ff6f00 0%, #ff5722 100%);
        border: none;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        color: white;
        font-weight: 500;
    }

    .btn-danger {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
        border: none;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        font-weight: 500;
    }

    .table {
        margin: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        color: white;
        border: none;
        font-weight: 600;
        padding: 1rem;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #ffebee;
        transform: scale(1.01);
    }

    .table tbody td {
        vertical-align: middle;
        padding: 1rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-success {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
    }

    .badge-secondary {
        background: linear-gradient(135deg, #868f96 0%, #596164 100%);
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #ffcdd2;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 0.2rem rgba(229, 57, 53, 0.25);
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .modal-footer {
        border: none;
        padding: 1.5rem;
    }

    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .no-image {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffcdd2 0%, #ef9a9a 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #e53935;
        font-size: 2rem;
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 10px;
        display: none;
    }

    .bg-danger {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%) !important;
    }

    .badge.bg-info {
        background: linear-gradient(135deg, #ff6f00 0%, #ff5722 100%) !important;
    }
</style>

<div class="content-header">
    <h1><i class="bi bi-box-seam"></i> Data Barang</h1>
    <p>Kelola informasi barang yang dijual</p>
</div>

<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Form Tambah Barang -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle"></i> Tambah Barang Baru
    </div>
    <div class="card-body">
        <form action="{{ route('staff.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_b') is-invalid @enderror" 
                           name="nama_b" placeholder="Masukkan nama barang" value="{{ old('nama_b') }}" required>
                    @error('nama_b')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <select class="form-select @error('id_kategori') is-invalid @enderror" name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
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
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           name="price" placeholder="Masukkan harga" value="{{ old('price') }}" step="0.01" min="0" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Gambar Barang</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           name="image" accept="image/*" onchange="previewImage(event, 'preview-add')">
                    <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Max: 2MB)</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <img id="preview-add" class="image-preview">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control @error('desc_b') is-invalid @enderror" 
                              name="desc_b" rows="3" placeholder="Masukkan deskripsi barang">{{ old('desc_b') }}</textarea>
                    @error('desc_b')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Data Barang -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Daftar Barang
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th width="20%">Nama Barang</th>
                        <th width="15%">Kategori</th>
                        <th width="12%">Harga</th>
                        <th width="8%">Stok</th>
                        <th width="10%">Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->image_path && file_exists(public_path('img/' . $item->image_path)))
                                <img src="{{ asset('img/' . $item->image_path) }}" alt="{{ $item->nama_b }}" class="product-image">
                            @else
                                <div class="no-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->nama_b }}</strong>
                            @if($item->desc_b)
                                <br><small class="text-muted">{{ Str::limit($item->desc_b, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $item->nama_kategori ?? 'Tanpa Kategori' }}</span>
                        </td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary">{{ $item->stok_b }}</span></td>
                        <td>
                            @if($item->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $item->id_barang }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal{{ $item->id_barang }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $item->id_barang }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-pencil"></i> Edit Barang</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('staff.barang.update', $item->id_barang) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_b" 
                                                   value="{{ $item->nama_b }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                            <select class="form-select" name="id_kategori" required>
                                                @foreach($kategori as $kat)
                                                    <option value="{{ $kat->id_kategori }}" 
                                                            {{ $item->id_kategori == $kat->id_kategori ? 'selected' : '' }}>
                                                        {{ $kat->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status" required>
                                                <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Gambar Barang</label>
                                            @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="Current" style="max-width: 150px; border-radius: 10px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="image" accept="image/*" 
                                                   onchange="previewImage(event, 'preview-edit-{{ $item->id_barang }}')">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                                            <img id="preview-edit-{{ $item->id_barang }}" class="image-preview">
                                        </div>

                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle"></i> <strong>Info:</strong> Stok dan harga tidak dapat diubah di sini
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $item->id_barang }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title"><i class="bi bi-trash"></i> Hapus Barang</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus barang <strong>{{ $item->nama_b }}</strong>?</p>
                                    <p class="text-danger"><i class="bi bi-exclamation-triangle"></i> Tindakan ini tidak dapat dibatalkan!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('staff.barang.destroy', $item->id_barang) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="mt-2 text-muted">Belum ada data barang</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
