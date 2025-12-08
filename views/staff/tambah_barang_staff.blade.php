@extends('staff.layouts')

@section('page-title', 'Tambah Stok Barang')

@section('content')
<div class="container-fluid py-4">
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Form Input Stok -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Stok Barang</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.stok.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Pilih Barang -->
                    <div class="col-md-6 mb-3">
                        <label for="id_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <select class="form-select" id="id_barang" name="id_barang" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}" data-stok="{{ $barang->stok_b }}">
                                    {{ $barang->nama_b }} (Stok: {{ $barang->stok_b }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jenis Transaksi -->
                    <div class="col-md-6 mb-3">
                        <label for="tipe" class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe" id="masuk" value="masuk" checked>
                                <label class="form-check-label" for="masuk">
                                    <i class="bi bi-arrow-down-circle text-success"></i> Masuk
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipe" id="keluar" value="keluar">
                                <label class="form-check-label" for="keluar">
                                    <i class="bi bi-arrow-up-circle text-danger"></i> Keluar
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah -->
                    <div class="col-md-6 mb-3">
                        <label for="kuantiti" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="kuantiti" name="kuantiti" min="1" required>
                        <small class="text-muted">Stok saat ini: <span id="stok-current">0</span></small>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-12 mb-3">
                        <label for="desc_tb" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="desc_tb" name="desc_tb" rows="3" placeholder="Masukkan keterangan transaksi (opsional)"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-save me-1"></i>Input Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Transaksi -->
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi Stok</h5>
            <span class="badge bg-light text-dark">Total: {{ $transaksis->total() }} transaksi</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-danger">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="10%">Gambar</th>
                            <th width="15%">Nama Barang</th>
                            <th width="10%" class="text-center">Jenis</th>
                            <th width="10%" class="text-center">Jumlah</th>
                            <th width="10%" class="text-center">Stok Sebelum</th>
                            <th width="10%" class="text-center">Stok Sesudah</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $index => $transaksi)
                        <tr>
                            <td class="text-center">{{ $transaksis->firstItem() + $index }}</td>
                            <td class="text-center">
                                @if($transaksi->barang->image_path && file_exists(public_path('img/' . $transaksi->barang->image_path)))
                                    <img src="{{ asset('img/' . $transaksi->barang->image_path) }}" 
                                        alt="{{ $transaksi->barang->nama_b }}" 
                                        class="img-thumbnail" 
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                        style="width: 60px; height: 60px;">
                                        <i class="bi bi-image fs-4"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $transaksi->barang->nama_b }}</td>
                            <td class="text-center">
                                @if($transaksi->tipe == 'masuk')
                                    <span class="badge bg-success">
                                        <i class="bi bi-arrow-down-circle"></i> Masuk
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-arrow-up-circle"></i> Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <strong>{{ $transaksi->kuantiti }}</strong>
                            </td>
                            <td class="text-center">{{ $transaksi->stok_sebelum }}</td>
                            <td class="text-center">
                                <strong class="{{ $transaksi->tipe == 'masuk' ? 'text-success' : 'text-danger' }}">
                                    {{ $transaksi->stok_sesudah }}
                                </strong>
                            </td>
                            <td>
                                <small>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y H:i') }}</small>
                                @if($transaksi->desc_tb)
                                    <br><small class="text-muted">{{ Str::limit($transaksi->desc_tb, 30) }}</small>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $transaksi->id_transb }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $transaksi->id_transb }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $transaksi->id_transb }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title">Edit Transaksi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('staff.stok.update', $transaksi->id_transb) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Barang</label>
                                                        <input type="text" class="form-control" value="{{ $transaksi->barang->nama_b }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jumlah</label>
                                                        <input type="number" class="form-control" name="kuantiti" value="{{ $transaksi->kuantiti }}" min="1" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Keterangan</label>
                                                        <textarea class="form-control" name="desc_tb" rows="3">{{ $transaksi->desc_tb }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="deleteModal{{ $transaksi->id_transb }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
                                                <ul class="list-unstyled">
                                                    <li><strong>Barang:</strong> {{ $transaksi->barang->nama_b }}</li>
                                                    <li><strong>Jumlah:</strong> {{ $transaksi->kuantiti }}</li>
                                                    <li><strong>Jenis:</strong> {{ ucfirst($transaksi->tipe) }}</li>
                                                </ul>
                                                <div class="alert alert-warning">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                    Stok barang akan dikembalikan ke kondisi sebelum transaksi ini.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('staff.stok.destroy', $transaksi->id_transb) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="text-muted mt-2">Belum ada transaksi stok</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $transaksis->firstItem() ?? 0 }} - {{ $transaksis->lastItem() ?? 0 }} dari {{ $transaksis->total() }} transaksi
                </div>
                <div>
                    {{ $transaksis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectBarang = document.getElementById('id_barang');
    const stokCurrent = document.getElementById('stok-current');
    
    selectBarang.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok') || 0;
        stokCurrent.textContent = stok;
    });
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>

<style>
.table td {
    vertical-align: middle;
}
.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}
</style>

@endsection
