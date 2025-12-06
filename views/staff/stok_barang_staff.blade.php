@extends('staff.layouts')

@section('page-title', 'Stok Barang')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-box-seam"></i>
            Stok Barang
        </h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="search-box">
                    <form action="{{ route('staff.stok_barang.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Cari nama barang atau kode..."
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        @if(request('search'))
                        <a href="{{ route('staff.stok_barang.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                        @endif
                    </form>
                </div>
                <div>
                    <a href="{{ route('staff.stok_barang.pdf', ['search' => request('search')]) }}" 
                       class="btn btn-danger" 
                       target="_blank">
                        <i class="bi bi-file-pdf"></i> Cetak PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th width="100">Gambar</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th width="120" class="text-center">Stok</th>
                            <th width="150">Harga</th>
                            <th width="100" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $index => $item)
                        <tr>
                            <td>{{ $barang->firstItem() + $index }}</td>
                            <td>
                                @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                                    <img src="{{ asset('storage/' . $item->image_path) }}" 
                                         alt="{{ $item->nama_b }}" 
                                         class="product-image"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div class="no-image" style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->id_barang }}</strong>
                            </td>
                            <td>
                                <strong>{{ $item->nama_b }}</strong>
                                @if($item->desc_b)
                                <br>
                                <small class="text-muted">{{ Str::limit($item->desc_b, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->kategori)
                                <span class="badge bg-info">{{ $item->kategori->nama_kategori }}</span>
                                @else
                                <span class="badge bg-secondary">Tidak ada kategori</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->stok_b <= 10)
                                <span class="badge bg-danger fs-6">
                                    <i class="bi bi-exclamation-triangle"></i> {{ $item->stok_b }}
                                </span>
                                @elseif($item->stok_b <= 50)
                                <span class="badge bg-warning fs-6">
                                    <i class="bi bi-dash-circle"></i> {{ $item->stok_b }}
                                </span>
                                @else
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle"></i> {{ $item->stok_b }}
                                </span>
                                @endif
                            </td>
                            <td>
                                <strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                            </td>
                            <td class="text-center">
                                @if($item->status == 'active')
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="mt-3 text-muted">
                                    @if(request('search'))
                                    Tidak ada barang ditemukan dengan kata kunci "{{ request('search') }}"
                                    @else
                                    Belum ada data barang
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $barang->firstItem() ?? 0 }} - {{ $barang->lastItem() ?? 0 }} 
                    dari {{ $barang->total() }} barang
                </div>
                <div>
                    {{ $barang->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Stok -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
                    <h3 class="mt-3">{{ $stokRendah }}</h3>
                    <p class="text-muted mb-0">Stok Rendah (≤10)</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <i class="bi bi-dash-circle-fill text-warning fs-1"></i>
                    <h3 class="mt-3">{{ $stokSedang }}</h3>
                    <p class="text-muted mb-0">Stok Sedang (11-50)</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                    <h3 class="mt-3">{{ $stokAman }}</h3>
                    <p class="text-muted mb-0">Stok Aman (>50)</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.content-wrapper {
    padding: 25px;
}

.page-header {
    margin-bottom: 30px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.card {
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-radius: 12px;
    margin-bottom: 25px;
}

.card-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    padding: 20px 25px;
    border-radius: 12px 12px 0 0;
}

.card-body {
    padding: 25px;
}

.search-box {
    flex: 1;
    max-width: 500px;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
    color: #6c757d;
    border-bottom: 2px solid #dee2e6;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.badge {
    padding: 6px 12px;
    font-weight: 500;
}

.alert {
    border-radius: 10px;
    border: none;
    padding: 15px 20px;
}
</style>
@endsection