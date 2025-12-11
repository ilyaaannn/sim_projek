<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Session::has('user') || Session::get('user.level') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return null;
    }

    // Helper function untuk upload gambar
    private function uploadImage($file, $oldPath = null)
    {
        try {
            // Pastikan folder img ada di public
            $destinationPath = public_path('img');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate nama file unik
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke folder public/img
            $file->move($destinationPath, $filename);

            // Hapus gambar lama jika ada (kecuali default)
            if ($oldPath && $oldPath != 'img/default.jpg' && $oldPath != 'img/no-image.jpg') {
                $oldFilePath = public_path($oldPath);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            return 'img/' . $filename;
        } catch (\Exception $e) {
            return null;
        }
    }

    // Dashboard Admin
    public function dashboard()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        // Statistik Dashboard
        $totalPenjualan = DB::table('tbl_order')
            ->where('status', 'selesai')
            ->sum('totalprice');

        $totalOrder = DB::table('tbl_order')->count();

        $totalBarang = DB::table('tbl_barang')
            ->where('status', 'active')
            ->count();

        $totalKostumer = DB::table('tbl_user')
            ->where('level', 'kostumer')
            ->count();

        // Order terbaru
        $recentOrders = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->select('tbl_order.*', 'tbl_user.username')
            ->orderBy('tbl_order.created_at', 'desc')
            ->limit(5)
            ->get();

        // Produk terlaris
        $topProducts = DB::table('tbl_barang_order')
            ->join('tbl_barang', 'tbl_barang_order.id_barang', '=', 'tbl_barang.id_barang')
            ->select('tbl_barang.nama_b', DB::raw('SUM(tbl_barang_order.kuantiti) as total_terjual'))
            ->groupBy('tbl_barang.id_barang', 'tbl_barang.nama_b')
            ->orderBy('total_terjual', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard_admin', compact(
            'totalPenjualan',
            'totalOrder',
            'totalBarang',
            'totalKostumer',
            'recentOrders',
            'topProducts'
        ));
    }

    // Kelola Penjualan
    public function penjualan()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $orders = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->select('tbl_order.*', 'tbl_user.username', 'tbl_user.phone')
            ->orderBy('tbl_order.created_at', 'desc')
            ->get();

        return view('admin.penjualan', compact('orders'));
    }

    // Detail Penjualan
    public function detailPenjualan($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $order = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->select('tbl_order.*', 'tbl_user.username', 'tbl_user.phone', 'tbl_user.email')
            ->where('tbl_order.id_order', $id)
            ->first();

        if (!$order) {
            return redirect()->route('admin.penjualan.index')
                ->with('error', 'Order tidak ditemukan!');
        }

        $orderItems = DB::table('tbl_barang_order')
            ->join('tbl_barang', 'tbl_barang_order.id_barang', '=', 'tbl_barang.id_barang')
            ->select('tbl_barang_order.*', 'tbl_barang.nama_b', 'tbl_barang.image_path')
            ->where('tbl_barang_order.id_order', $id)
            ->get();

        return view('admin.penjualan_detail', compact('order', 'orderItems'));
    }

    // Update Status Penjualan
    public function updateStatusPenjualan(Request $request, $id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal'
        ]);

        DB::table('tbl_order')
            ->where('id_order', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        return back()->with('success', 'Status penjualan berhasil diupdate!');
    }

    // Kelola Barang
    public function barang()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $barang = DB::table('tbl_barang')
            ->join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
            ->orderBy('tbl_barang.created_at', 'desc')
            ->get();

        $kategori = DB::table('tbl_kategori')->get();

        return view('admin.barang', compact('barang', 'kategori'));
    }

    // Store Barang - DIPERBAIKI DENGAN UPLOAD IMAGE
    public function storeBarang(Request $request)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $request->validate([
            'nama_b' => 'required|string|max:150',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'price' => 'required|numeric|min:0',
            'stok_b' => 'required|integer|min:0',
            'desc_b' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB max
        ], [
            'nama_b.required' => 'Nama barang harus diisi',
            'nama_b.max' => 'Nama barang maksimal 150 karakter',
            'id_kategori.required' => 'Kategori harus dipilih',
            'id_kategori.exists' => 'Kategori tidak valid',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'stok_b.required' => 'Stok harus diisi',
            'stok_b.integer' => 'Stok harus berupa angka bulat',
            'stok_b.min' => 'Stok tidak boleh negatif',
            'desc_b.max' => 'Deskripsi maksimal 1000 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        try {
            DB::beginTransaction();

            // Handle upload gambar
            $imagePath = 'img/default.jpg'; // Default image
            if ($request->hasFile('image')) {
                $uploadedPath = $this->uploadImage($request->file('image'));
                if ($uploadedPath) {
                    $imagePath = $uploadedPath;
                }
            }

            // Insert barang
            $barangId = DB::table('tbl_barang')->insertGetId([
                'nama_b' => $request->nama_b,
                'desc_b' => $request->desc_b,
                'id_kategori' => $request->id_kategori,
                'stok_b' => $request->stok_b,
                'price' => $request->price,
                'image_path' => $imagePath,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Catat transaksi masuk stok awal jika ada
            if ($request->stok_b > 0) {
                DB::table('tbl_transaksi_barang')->insert([
                    'id_barang' => $barangId,
                    'tipe' => 'masuk',
                    'kuantiti' => $request->stok_b,
                    'stok_sebelum' => 0,
                    'stok_sesudah' => $request->stok_b,
                    'desc_tb' => 'Stok awal barang baru: ' . $request->nama_b,
                    'id_user' => Session::get('user.id_user'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.barang.index')
                ->with('success', 'Barang "' . $request->nama_b . '" berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan barang: ' . $e->getMessage());
        }
    }

    // Update Barang - DIPERBAIKI DENGAN UPLOAD IMAGE
    public function updateBarang(Request $request, $id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $request->validate([
            'nama_b' => 'required|string|max:150',
            'id_kategori' => 'required|exists:tbl_kategori,id_kategori',
            'price' => 'required|numeric|min:0',
            'stok_b' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'desc_b' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama_b.required' => 'Nama barang harus diisi',
            'id_kategori.required' => 'Kategori harus dipilih',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'stok_b.required' => 'Stok harus diisi',
            'stok_b.integer' => 'Stok harus berupa angka bulat',
            'status.required' => 'Status harus dipilih',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        try {
            DB::beginTransaction();

            // Ambil data barang lama
            $barangLama = DB::table('tbl_barang')->where('id_barang', $id)->first();

            if (!$barangLama) {
                return back()->with('error', 'Barang tidak ditemukan!');
            }

            $stokLama = $barangLama->stok_b;
            $imagePath = $barangLama->image_path;

            // Handle upload gambar baru jika ada
            if ($request->hasFile('image')) {
                $uploadedPath = $this->uploadImage($request->file('image'), $imagePath);
                if ($uploadedPath) {
                    $imagePath = $uploadedPath;
                }
            }

            // Update barang
            DB::table('tbl_barang')
                ->where('id_barang', $id)
                ->update([
                    'nama_b' => $request->nama_b,
                    'desc_b' => $request->desc_b,
                    'id_kategori' => $request->id_kategori,
                    'stok_b' => $request->stok_b,
                    'price' => $request->price,
                    'status' => $request->status,
                    'image_path' => $imagePath,
                    'updated_at' => now(),
                ]);

            // Catat transaksi jika ada perubahan stok
            if ($stokLama != $request->stok_b) {
                $selisih = $request->stok_b - $stokLama;
                $tipe = $selisih > 0 ? 'masuk' : 'keluar';
                $kuantiti = abs($selisih);

                DB::table('tbl_transaksi_barang')->insert([
                    'id_barang' => $id,
                    'tipe' => $tipe,
                    'kuantiti' => $kuantiti,
                    'stok_sebelum' => $stokLama,
                    'stok_sesudah' => $request->stok_b,
                    'desc_tb' => 'Update stok melalui edit barang',
                    'id_user' => Session::get('user.id_user'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.barang.index')
                ->with('success', 'Barang "' . $request->nama_b . '" berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate barang: ' . $e->getMessage());
        }
    }

    // Delete Barang - DIPERBAIKI DENGAN HAPUS GAMBAR
    public function destroyBarang($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        try {
            // Cek apakah barang pernah dipesan
            $orderCount = DB::table('tbl_barang_order')
                ->where('id_barang', $id)
                ->count();

            if ($orderCount > 0) {
                return back()->with('error', 'Barang tidak dapat dihapus karena sudah pernah dipesan! Anda bisa menonaktifkan barang ini.');
            }

            // Ambil data barang
            $barang = DB::table('tbl_barang')->where('id_barang', $id)->first();

            if (!$barang) {
                return back()->with('error', 'Barang tidak ditemukan!');
            }

            DB::beginTransaction();

            // Hapus gambar jika bukan default
            if ($barang->image_path && $barang->image_path != 'img/default.jpg' && $barang->image_path != 'img/no-image.jpg') {
                $imagePath = public_path($barang->image_path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Hapus transaksi terkait
            DB::table('tbl_transaksi_barang')->where('id_barang', $id)->delete();

            // Hapus barang
            DB::table('tbl_barang')->where('id_barang', $id)->delete();

            DB::commit();

            return back()->with('success', 'Barang "' . $barang->nama_b . '" berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat menghapus barang: ' . $e->getMessage());
        }
    }

    // Lihat Stok
    public function stok()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $stok = DB::table('tbl_barang')
            ->join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
            ->orderBy('tbl_barang.stok_b', 'asc')
            ->get();

        return view('admin.stok', compact('stok'));
    }

    // Transaksi Barang
    public function transaksi()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $transaksi = DB::table('tbl_transaksi_barang')
            ->join('tbl_barang', 'tbl_transaksi_barang.id_barang', '=', 'tbl_barang.id_barang')
            ->join('tbl_user', 'tbl_transaksi_barang.id_user', '=', 'tbl_user.id_user')
            ->select('tbl_transaksi_barang.*', 'tbl_barang.nama_b', 'tbl_user.username')
            ->orderBy('tbl_transaksi_barang.created_at', 'desc')
            ->get();

        $barang = DB::table('tbl_barang')
            ->where('status', 'active')
            ->orderBy('nama_b', 'asc')
            ->get();

        return view('admin.transaksi', compact('transaksi', 'barang'));
    }

    // Store Transaksi
    public function storeTransaksi(Request $request)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $request->validate([
            'id_barang' => 'required|exists:tbl_barang,id_barang',
            'tipe' => 'required|in:masuk,keluar',
            'kuantiti' => 'required|numeric|min:1',
            'desc_tb' => 'required|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $barang = DB::table('tbl_barang')->where('id_barang', $request->id_barang)->first();
            $stokSebelum = $barang->stok_b;
            $stokSesudah = ($request->tipe == 'masuk')
                ? $stokSebelum + $request->kuantiti
                : $stokSebelum - $request->kuantiti;

            if ($stokSesudah < 0) {
                return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $stokSebelum);
            }

            DB::table('tbl_transaksi_barang')->insert([
                'id_barang' => $request->id_barang,
                'tipe' => $request->tipe,
                'kuantiti' => $request->kuantiti,
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'desc_tb' => $request->desc_tb,
                'id_user' => Session::get('user.id_user'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('tbl_barang')
                ->where('id_barang', $request->id_barang)
                ->update([
                    'stok_b' => $stokSesudah,
                    'updated_at' => now()
                ]);

            DB::commit();

            return back()->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Laporan Penjualan
    public function laporan(Request $request)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $query = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->select('tbl_order.*', 'tbl_user.username');

        if ($request->has('status') && $request->status != '') {
            $query->where('tbl_order.status', $request->status);
        }

        if ($request->has('dari') && $request->has('sampai')) {
            $query->whereBetween('tbl_order.created_at', [$request->dari, $request->sampai]);
        }

        $laporan = $query->orderBy('tbl_order.created_at', 'desc')->get();

        $totalPendapatan = DB::table('tbl_order')
            ->where('status', 'selesai')
            ->when($request->has('dari') && $request->has('sampai'), function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->dari, $request->sampai]);
            })
            ->sum('totalprice');

        return view('admin.laporan', compact('laporan', 'totalPendapatan'));
    }

    // Laporan PDF
    public function laporanPDF(Request $request)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $query = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->select('tbl_order.*', 'tbl_user.username')
            ->where('tbl_order.status', 'selesai');

        if ($request->has('dari') && $request->has('sampai')) {
            $query->whereBetween('tbl_order.created_at', [$request->dari, $request->sampai]);
        }

        $laporan = $query->orderBy('tbl_order.created_at', 'desc')->get();
        $totalPendapatan = $laporan->sum('totalprice');

        $pdf = PDF::loadView('admin.laporan_pdf', compact('laporan', 'totalPendapatan'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
