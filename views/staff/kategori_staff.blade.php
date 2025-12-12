@extends('staff.layouts')

@section('page-title', 'Kategori')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">kategori barang</h4>
                </div>
                <div class="card-body">
                    <!-- Alert Messages -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Form Tambah/Edit Kategori -->
                    <div class="bg-danger text-white p-3 mb-3 rounded">
                        <h5 class="mb-3">
                            <i class="bi bi-plus-circle"></i> 
                            <span id="form-title">tambah kategory baru</span>
                        </h5>
                        
                        <form id="kategoriForm" method="POST" action="{{ route('staff.kategori.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" id="formMethod" value="POST">
                            <input type="hidden" name="kategori_id" id="kategori_id">
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" 
                                           placeholder="Nama Kategori" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" 
                                              rows="1" placeholder="Deskripsi"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Gambar Kategori</label>
                                    <input type="file" class="form-control" name="gambar" id="gambar" 
                                           accept="image/jpeg,image/jpg,image/png,image/gif">
                                    <small class="text-white-50">Max: 2MB (jpeg, jpg, png, gif)</small>
                                    <div id="preview-container" class="mt-2" style="display: none;">
                                        <img id="image-preview" src="" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 5px;">
                                        <input type="hidden" id="current_gambar" value="">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-dark w-100" id="submitBtn">
                                        simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary w-100 ms-2 d-none" id="cancelBtn" onclick="resetForm()">
                                        batal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Kategori -->
                    <div class="table-responsive">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <label>Show 
                                    <select class="form-select form-select-sm d-inline-block" style="width: auto;">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                    </select>
                                    Entries
                                </label>
                            </div>
                            <div>
                                <label>Search: 
                                    <input type="search" class="form-control form-control-sm" id="searchInput">
                                </label>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="table-danger">
                                <tr>
                                    <th>NO</th>
                                    <th>Gambar</th>
                                    <th>Nama Kategory</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="kategoriTable">
                                @forelse($kategori as $index => $item)
                                <tr>
                                    <td>{{ $kategori->firstItem() + $index }}</td>
                                    <td class="text-center">
                                        @if($item->gambar_path)
                                            <img src="{{ asset('img/' . $item->gambar_path) }}" 
                                                 alt="{{ $item->nama_kategori }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"
                                                 onerror="this.src='{{ asset('img/no-image.png') }}'">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>{{ $item->deskripsi ?? '..' }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="editKategori({{ $item->id_kategori }}, '{{ $item->nama_kategori }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->gambar_path }}')">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteKategori({{ $item->id_kategori }}, '{{ $item->nama_kategori }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data kategori</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                Showing {{ $kategori->firstItem() ?? 0 }} to {{ $kategori->lastItem() ?? 0 }} of {{ $kategori->total() }} entries
                            </div>
                            <div>
                                {{ $kategori->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete Hidden -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Preview gambar saat dipilih
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

// Edit Kategori
function editKategori(id, nama, deskripsi, gambar) {
    document.getElementById('form-title').textContent = 'edit kategory';
    document.getElementById('kategori_id').value = id;
    document.getElementById('nama_kategori').value = nama;
    document.getElementById('deskripsi').value = deskripsi || '';
    document.getElementById('current_gambar').value = gambar || '';
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('kategoriForm').action = "{{ route('staff.kategori.update', ':id') }}".replace(':id', id);
    document.getElementById('submitBtn').textContent = 'update';
    document.getElementById('cancelBtn').classList.remove('d-none');
    
    // Show current image if exists
    if (gambar) {
        document.getElementById('image-preview').src = "{{ asset('img') }}/" + gambar;
        document.getElementById('preview-container').style.display = 'block';
    } else {
        document.getElementById('preview-container').style.display = 'none';
    }
    
    // Scroll to form
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Reset Form
function resetForm() {
    document.getElementById('form-title').textContent = 'tambah kategory baru';
    document.getElementById('kategoriForm').reset();
    document.getElementById('kategori_id').value = '';
    document.getElementById('current_gambar').value = '';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('kategoriForm').action = "{{ route('staff.kategori.store') }}";
    document.getElementById('submitBtn').textContent = 'simpan';
    document.getElementById('cancelBtn').classList.add('d-none');
    document.getElementById('preview-container').style.display = 'none';
}

// Delete Kategori
function deleteKategori(id, nama) {
    if(confirm('Apakah Anda yakin ingin menghapus kategori "' + nama + '"? Gambar kategori juga akan dihapus.')) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ route('staff.kategori.destroy', ':id') }}".replace(':id', id);
        form.submit();
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#kategoriTable tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});
</script>
@endsection
