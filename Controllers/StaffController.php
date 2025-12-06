<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\TransaksiBarang;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function dashboardStaff()
    {
        // Total jenis barang
        $totalJenisBarang = Barang::where('status', 'active')->count();
        
        // Total stok barang
        $totalStokBarang = Barang::where('status', 'active')->sum('stok_b');
        
        // Total transaksi minggu ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $totalTransaksiMingguIni = TransaksiBarang::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        
        // Data untuk grafik per bulan (12 bulan terakhir)
        $dataGrafik = $this->getDataGrafikPerBulan();
        
        return view('staff.dashboard_staff', compact(
            'totalJenisBarang',
            'totalStokBarang',
            'totalTransaksiMingguIni',
            'dataGrafik'
        ));
    }
    
    private function getDataGrafikPerBulan()
    {
        $bulanSekarang = Carbon::now();
        $dataGrafik = [
            'labels' => [],
            'pemasukan' => [],
            'pengeluaran' => []
        ];
        
        // Loop 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $bulan = $bulanSekarang->copy()->subMonths($i);
            $bulanNama = $bulan->format('M'); // Jan, Feb, Mar, dst
            
            // Hitung total pemasukan (tipe 'masuk')
            $pemasukan = TransaksiBarang::where('tipe', 'masuk')
                ->whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->sum('kuantiti');
            
            // Hitung total pengeluaran (tipe 'keluar')
            $pengeluaran = TransaksiBarang::where('tipe', 'keluar')
                ->whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->sum('kuantiti');
            
            $dataGrafik['labels'][] = $bulanNama;
            $dataGrafik['pemasukan'][] = $pemasukan;
            $dataGrafik['pengeluaran'][] = $pengeluaran;
        }
        
        return $dataGrafik;
    }

    public function kategori()
    {
        $kategori = Kategori::orderBy('created_at', 'desc')->paginate(10);
        return view('staff.kategori_staff', compact('kategori'));
    }

    public function storek(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('staff.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updatek(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('staff.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroyk($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('staff.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

   public function dataBarang()
    {
        $barang = DB::table('tbl_barang')
            ->leftJoin('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
            ->orderBy('tbl_barang.id_barang', 'desc')
            ->get();
        
        $kategori = DB::table('tbl_kategori')->get();
        
        return view('staff.data_barang_staff', compact('barang', 'kategori'));
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_b' => 'required|max:150',
            'desc_b' => 'nullable',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $imagePath = null;
        
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke storage/app/public/barang
            // File akan dapat diakses via public/storage/barang
            $imagePath = $request->file('image')->store('barang', 'public');
        }

        DB::table('tbl_barang')->insert([
            'nama_b' => $request->nama_b,
            'desc_b' => $request->desc_b,
            'id_kategori' => $request->id_kategori,
            'stok_b' => 0,
            'price' => $request->price,
            'image_path' => $imagePath, // Simpan path relatif: barang/filename.jpg
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('staff.barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }

    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'nama_b' => 'required|max:150',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $barang = DB::table('tbl_barang')->where('id_barang', $id)->first();
        
        if (!$barang) {
            return redirect()->route('staff.barang.index')->with('error', 'Barang tidak ditemukan');
        }

        $imagePath = $barang->image_path;
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            // Upload gambar baru
            $imagePath = $request->file('image')->store('barang', 'public');
        }

        DB::table('tbl_barang')
            ->where('id_barang', $id)
            ->update([
                'nama_b' => $request->nama_b,
                'id_kategori' => $request->id_kategori,
                'status' => $request->status,
                'image_path' => $imagePath,
                'updated_at' => now()
            ]);

        return redirect()->route('staff.barang.index')->with('success', 'Data barang berhasil diupdate');
    }

    public function destroyBarang($id)
    {
        $barang = DB::table('tbl_barang')->where('id_barang', $id)->first();
        
        if (!$barang) {
            return redirect()->route('staff.barang.index')->with('error', 'Barang tidak ditemukan');
        }

        // Hapus gambar jika ada
        if ($barang->image_path && Storage::disk('public')->exists($barang->image_path)) {
            Storage::disk('public')->delete($barang->image_path);
        }

        DB::table('tbl_barang')->where('id_barang', $id)->delete();

        return redirect()->route('staff.barang.index')->with('success', 'Data barang berhasil dihapus');
    }

    /**
     * Menampilkan halaman tambah stok barang
     */
    public function tambahStok()
    {
        $barangs = Barang::where('status', 'active')
            ->orderBy('nama_b', 'asc')
            ->get();
        
        $transaksis = TransaksiBarang::with('barang')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('staff.tambah_barang_staff', compact('barangs', 'transaksis'));
    }

    /**
     * Menyimpan transaksi stok baru
     */
    public function storeStok(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:tbl_barang,id_barang',
            'tipe' => 'required|in:masuk,keluar',
            'kuantiti' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'desc_tb' => 'nullable|string|max:500'
        ], [
            'id_barang.required' => 'Barang harus dipilih',
            'id_barang.exists' => 'Barang tidak ditemukan',
            'tipe.required' => 'Jenis transaksi harus dipilih',
            'tipe.in' => 'Jenis transaksi tidak valid',
            'kuantiti.required' => 'Jumlah harus diisi',
            'kuantiti.integer' => 'Jumlah harus berupa angka',
            'kuantiti.min' => 'Jumlah minimal 1',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid'
        ]);

        try {
            DB::beginTransaction();

            // Ambil user_id dari session (sesuaikan dengan cara login Anda)
            $userId = session('id_user') ?? session('user_id') ?? 1; // fallback ke 1 jika tidak ada

            // Ambil data barang
            $barang = Barang::findOrFail($request->id_barang);
            $stokSebelum = $barang->stok_b;
            
            // Validasi stok keluar
            if ($request->tipe == 'keluar' && $stokSebelum < $request->kuantiti) {
                return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $stokSebelum);
            }

            // Hitung stok sesudah
            if ($request->tipe == 'masuk') {
                $stokSesudah = $stokSebelum + $request->kuantiti;
            } else {
                $stokSesudah = $stokSebelum - $request->kuantiti;
            }

            // Simpan transaksi
            TransaksiBarang::create([
                'id_barang' => $request->id_barang,
                'tipe' => $request->tipe,
                'kuantiti' => $request->kuantiti,
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'desc_tb' => $request->desc_tb,
                'user_id' => $userId
            ]);

            // Update stok barang
            $barang->update(['stok_b' => $stokSesudah]);

            DB::commit();

            return back()->with('success', 'Transaksi stok berhasil ditambahkan! Stok ' . ucfirst($request->tipe) . ': ' . $request->kuantiti);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Update transaksi stok
     */
    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'kuantiti' => 'required|integer|min:1',
            'desc_tb' => 'nullable|string|max:500'
        ], [
            'kuantiti.required' => 'Jumlah harus diisi',
            'kuantiti.integer' => 'Jumlah harus berupa angka',
            'kuantiti.min' => 'Jumlah minimal 1'
        ]);

        try {
            DB::beginTransaction();

            $transaksi = TransaksiBarang::findOrFail($id);
            $barang = Barang::findOrFail($transaksi->id_barang);

            // Kembalikan stok ke kondisi sebelum transaksi lama
            $barang->stok_b = $transaksi->stok_sebelum;

            // Hitung stok baru dengan kuantiti yang diupdate
            if ($transaksi->tipe == 'masuk') {
                $stokSesudahBaru = $transaksi->stok_sebelum + $request->kuantiti;
            } else {
                // Validasi stok keluar
                if ($transaksi->stok_sebelum < $request->kuantiti) {
                    return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $transaksi->stok_sebelum);
                }
                $stokSesudahBaru = $transaksi->stok_sebelum - $request->kuantiti;
            }

            // Update transaksi
            $transaksi->update([
                'kuantiti' => $request->kuantiti,
                'stok_sesudah' => $stokSesudahBaru,
                'desc_tb' => $request->desc_tb
            ]);

            // Update stok barang
            $barang->update(['stok_b' => $stokSesudahBaru]);

            DB::commit();

            return back()->with('success', 'Transaksi berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Hapus transaksi stok
     */
    public function destroyStok($id)
    {
        try {
            DB::beginTransaction();

            $transaksi = TransaksiBarang::findOrFail($id);
            $barang = Barang::findOrFail($transaksi->id_barang);

            // Kembalikan stok ke kondisi sebelum transaksi
            $barang->update(['stok_b' => $transaksi->stok_sebelum]);

            // Hapus transaksi
            $transaksi->delete();

            DB::commit();

            return back()->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

     public function stokBarang(Request $request)
    {
        $search = $request->input('search');
        
        $query = DB::table('tbl_barang')
            ->leftJoin('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select(
                'tbl_barang.*',
                'tbl_kategori.nama_kategori'
            )
            ->orderBy('tbl_barang.stok_b', 'asc');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tbl_barang.nama_b', 'LIKE', "%{$search}%")
                  ->orWhere('tbl_barang.id_barang', 'LIKE', "%{$search}%")
                  ->orWhere('tbl_kategori.nama_kategori', 'LIKE', "%{$search}%");
            });
        }
        
        $barang = $query->paginate(10)->appends(['search' => $search]);
        
        $barang->getCollection()->transform(function ($item) {
            $item->kategori = (object)[
                'nama_kategori' => $item->nama_kategori
            ];
            return $item;
        });
        
        $stokRendah = DB::table('tbl_barang')->where('stok_b', '<=', 10)->count();
        $stokSedang = DB::table('tbl_barang')->whereBetween('stok_b', [11, 50])->count();
        $stokAman = DB::table('tbl_barang')->where('stok_b', '>', 50)->count();
        
        return view('staff.stok_barang_staff', compact('barang', 'stokRendah', 'stokSedang', 'stokAman'));
    }

    // Method untuk generate PDF laporan stok
    public function cetakStokPDF(Request $request)
    {
        $search = $request->input('search');
        
        $query = DB::table('tbl_barang')
            ->leftJoin('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select(
                'tbl_barang.*',
                'tbl_kategori.nama_kategori'
            )
            ->orderBy('tbl_barang.stok_b', 'asc');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tbl_barang.nama_b', 'LIKE', "%{$search}%")
                  ->orWhere('tbl_barang.id_barang', 'LIKE', "%{$search}%")
                  ->orWhere('tbl_kategori.nama_kategori', 'LIKE', "%{$search}%");
            });
        }
        
        $barang = $query->get();
        
        $totalBarang = $barang->count();
        $totalStok = $barang->sum('stok_b');
        $stokRendah = $barang->where('stok_b', '<=', 10)->count();
        $stokSedang = $barang->whereBetween('stok_b', [11, 50])->count();
        $stokAman = $barang->where('stok_b', '>', 50)->count();
        
        $data = [
            'barang' => $barang,
            'totalBarang' => $totalBarang,
            'totalStok' => $totalStok,
            'stokRendah' => $stokRendah,
            'stokSedang' => $stokSedang,
            'stokAman' => $stokAman,
            'tanggal' => now()->format('d/m/Y H:i:s'),
            'search' => $search
        ];
        
        $pdf = PDF::loadView('staff.pdf.stok_barang_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Stok_Barang_' . date('YmdHis') . '.pdf');
    }
}