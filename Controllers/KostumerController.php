<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class KostumerController extends Controller
{
    // Middleware untuk memastikan user adalah kostumer
    private function checkKostumer()
    {
        if (!Session::has('user') || Session::get('user.level') !== 'kostumer') {
            return redirect()->route('login');
        }
        return null;
    }

    // Halaman Dashboard dengan statistik
    public function dashboard()
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $userId = Session::get('user.id_user');

        // Ambil data kategori
        $kategoris = DB::table('tbl_kategori')->get();

        // Tambahkan logika fallback untuk gambar kategori
        foreach ($kategoris as $kategori) {
            $kategori->gambar_path = $this->getImagePath($kategori->gambar_path, 'category-icon.png');
        }

        // STATISTIK UNTUK DASHBOARD
        // 1. Total Produk Aktif yang Tersedia
        $totalProduk = DB::table('tbl_barang')
            ->where('status', 'active')
            ->where('stok_b', '>', 0)
            ->count();

        // 2. Total Item di Keranjang User
        $keranjang = Session::get('keranjang', []);
        $itemKeranjang = count($keranjang);

        // 3. Total Pesanan User
        $totalPesanan = DB::table('tbl_order')
            ->where('user_id', $userId)
            ->count();

        // 4. Pesanan Pending User (opsional, bisa ditambahkan ke stats card)
        $pesananPending = DB::table('tbl_order')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        // 5. Total Nilai Pesanan User (opsional)
        $totalNilaiPesanan = DB::table('tbl_order')
            ->where('user_id', $userId)
            ->sum('totalprice');

        return view('dashboard_kostumer', compact(
            'kategoris',
            'totalProduk',
            'itemKeranjang',
            'totalPesanan',
            'pesananPending',
            'totalNilaiPesanan'
        ));
    }

    // TAMBAHKAN method helper untuk handle gambar
    private function getImagePath($path, $default = 'no-image.jpg')
    {
        if (empty($path)) {
            return asset('img/' . $default);
        }

        // Cek apakah file ada di public
        $publicPath = public_path($path);
        if (file_exists($publicPath)) {
            return asset($path);
        }

        // Coba cari di folder img jika path relatif
        $imgPath = 'img/' . basename($path);
        $publicImgPath = public_path($imgPath);
        if (file_exists($publicImgPath)) {
            return asset($imgPath);
        }

        // Return gambar default
        return asset('img/' . $default);
    }

    // Halaman Produk
    public function produk(Request $request)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $search = $request->get('search');
        $kategoriId = $request->get('kategori');

        $query = DB::table('tbl_barang')
            ->join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->where('tbl_barang.status', 'active')
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori');

        if ($search) {
            $query->where('tbl_barang.nama_b', 'like', "%$search%");
        }

        if ($kategoriId) {
            $query->where('tbl_barang.id_kategori', $kategoriId);
        }

        $produks = $query->paginate(12);
        $kategoris = DB::table('tbl_kategori')->get();

        // Jika ada filter kategori, ambil data kategorinya
        $kategori = null;
        if ($kategoriId) {
            $kategori = DB::table('tbl_kategori')->where('id_kategori', $kategoriId)->first();
        }

        return view('kostumer.produk', compact('produks', 'kategoris', 'search', 'kategori'));
    }

    // Produk berdasarkan kategori
    public function produkByKategori($id)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $kategori = DB::table('tbl_kategori')->where('id_kategori', $id)->first();

        if (!$kategori) {
            return redirect()->route('kostumer.produk')->with('error', 'Kategori tidak ditemukan');
        }

        $produks = DB::table('tbl_barang')
            ->join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->where('tbl_barang.id_kategori', $id)
            ->where('tbl_barang.status', 'active')
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
            ->paginate(12);

        $kategoris = DB::table('tbl_kategori')->get();

        return view('kostumer.produk', [
            'produks' => $produks,
            'kategoris' => $kategoris,
            'kategori' => $kategori
        ]);
    }

    // Detail Produk
    public function detailProduk($id)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $produk = DB::table('tbl_barang')
            ->join('tbl_kategori', 'tbl_barang.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->where('tbl_barang.id_barang', $id)
            ->select('tbl_barang.*', 'tbl_kategori.nama_kategori')
            ->first();

        if (!$produk) {
            return redirect()->route('kostumer.produk')->with('error', 'Produk tidak ditemukan');
        }

        $produkTerkait = DB::table('tbl_barang')
            ->where('id_kategori', $produk->id_kategori)
            ->where('id_barang', '!=', $id)
            ->where('status', 'active')
            ->where('stok_b', '>', 0)
            ->limit(4)
            ->get();

        return view('kostumer.detail_produk', compact('produk', 'produkTerkait'));
    }

    // Halaman Keranjang
    public function keranjang()
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $keranjang = Session::get('keranjang', []);
        $total = 0;

        foreach ($keranjang as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('kostumer.keranjang', compact('keranjang', 'total'));
    }

    // Tambah ke Keranjang
    public function tambahKeranjang(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $produk = DB::table('tbl_barang')->where('id_barang', $request->id_barang)->first();

        if (!$produk || $produk->status !== 'active') {
            return back()->with('error', 'Produk tidak tersedia');
        }

        if ($produk->stok_b < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $keranjang = Session::get('keranjang', []);
        $id = $request->id_barang;

        if (isset($keranjang[$id])) {
            $newQuantity = $keranjang[$id]['quantity'] + $request->quantity;
            if ($produk->stok_b < $newQuantity) {
                return back()->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta');
            }
            $keranjang[$id]['quantity'] = $newQuantity;
        } else {
            $keranjang[$id] = [
                'id_barang' => $produk->id_barang,
                'nama_b' => $produk->nama_b,
                'price' => $produk->price,
                'quantity' => $request->quantity,
                'image_path' => $produk->image_path,
                'stok_b' => $produk->stok_b
            ];
        }

        Session::put('keranjang', $keranjang);
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Update Keranjang
    public function updateKeranjang(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $keranjang = Session::get('keranjang', []);

        if (isset($keranjang[$id])) {
            $produk = DB::table('tbl_barang')->where('id_barang', $id)->first();

            if (!$produk) {
                return back()->with('error', 'Produk tidak ditemukan');
            }

            if ($produk->stok_b < $request->quantity) {
                return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk->stok_b);
            }

            $keranjang[$id]['quantity'] = $request->quantity;
            $keranjang[$id]['stok_b'] = $produk->stok_b; // Update stok terbaru
            Session::put('keranjang', $keranjang);
            return back()->with('success', 'Keranjang berhasil diupdate');
        }

        return back()->with('error', 'Item tidak ditemukan');
    }

    // Hapus dari Keranjang
    public function hapusKeranjang($id)
    {
        $keranjang = Session::get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            Session::put('keranjang', $keranjang);
            return back()->with('success', 'Item berhasil dihapus dari keranjang');
        }

        return back()->with('error', 'Item tidak ditemukan');
    }

    // Halaman Checkout - DIPERBAIKI
    public function checkout()
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $keranjang = Session::get('keranjang', []);

        // Validasi keranjang kosong
        if (empty($keranjang)) {
            return redirect()->route('kostumer.produk')
                ->with('error', 'Keranjang masih kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        // Validasi stok sebelum checkout
        foreach ($keranjang as $id => $item) {
            $produk = DB::table('tbl_barang')
                ->where('id_barang', $id)
                ->where('status', 'active')
                ->first();

            if (!$produk) {
                // Hapus item yang tidak ada dari keranjang
                unset($keranjang[$id]);
                Session::put('keranjang', $keranjang);
                return redirect()->route('kostumer.keranjang')
                    ->with('error', 'Produk "' . $item['nama_b'] . '" tidak tersedia lagi');
            }

            if ($produk->stok_b < $item['quantity']) {
                return redirect()->route('kostumer.keranjang')
                    ->with('error', 'Stok produk "' . $item['nama_b'] . '" tidak mencukupi. Stok tersedia: ' . $produk->stok_b);
            }

            // Update stok terbaru di session
            $keranjang[$id]['stok_b'] = $produk->stok_b;
            $keranjang[$id]['price'] = $produk->price; // Update harga terbaru juga
        }

        Session::put('keranjang', $keranjang);

        // Hitung total
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Ambil data user
        $user = Session::get('user');

        return view('kostumer.checkout', compact('keranjang', 'total', 'user'));
    }

    // Buat Order - DIPERBAIKI & DISESUAIKAN DATABASE
    public function buatOrder(Request $request)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        // Validasi input
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:500',
            'catatan' => 'nullable|string|max:1000'
        ], [
            'alamat_pengiriman.required' => 'Alamat pengiriman harus diisi',
            'alamat_pengiriman.min' => 'Alamat pengiriman minimal 10 karakter',
            'alamat_pengiriman.max' => 'Alamat pengiriman maksimal 500 karakter',
            'catatan.max' => 'Catatan maksimal 1000 karakter'
        ]);

        $keranjang = Session::get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('kostumer.produk')
                ->with('error', 'Keranjang masih kosong');
        }

        DB::beginTransaction();
        try {
            $userId = Session::get('user.id_user');
            $totalPrice = 0;

            // Validasi stok dan hitung total
            foreach ($keranjang as $item) {
                $produk = DB::table('tbl_barang')
                    ->where('id_barang', $item['id_barang'])
                    ->where('status', 'active')
                    ->lockForUpdate() // Lock row untuk menghindari race condition
                    ->first();

                if (!$produk) {
                    throw new \Exception('Produk "' . $item['nama_b'] . '" tidak ditemukan atau sudah tidak aktif');
                }

                if ($produk->stok_b < $item['quantity']) {
                    throw new \Exception('Stok produk "' . $item['nama_b'] . '" tidak mencukupi. Stok tersedia: ' . $produk->stok_b);
                }

                $totalPrice += $produk->price * $item['quantity'];
            }

            // Buat order - SESUAI STRUKTUR DATABASE
            $orderId = DB::table('tbl_order')->insertGetId([
                'user_id' => $userId,
                'status' => 'pending',
                'totalprice' => $totalPrice,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'catatan' => $request->catatan,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Insert detail order dan update stok
            foreach ($keranjang as $item) {
                $barang = DB::table('tbl_barang')
                    ->where('id_barang', $item['id_barang'])
                    ->first();

                // Insert ke tbl_barang_order - SESUAI STRUKTUR DATABASE
                DB::table('tbl_barang_order')->insert([
                    'id_order' => $orderId,
                    'id_barang' => $item['id_barang'],
                    'id_kategori' => $barang->id_kategori,
                    'kuantiti' => $item['quantity'],
                    'price' => $barang->price,
                    'total' => $barang->price * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Update stok barang
                $stokBaru = $barang->stok_b - $item['quantity'];

                DB::table('tbl_barang')
                    ->where('id_barang', $item['id_barang'])
                    ->update([
                        'stok_b' => $stokBaru,
                        'updated_at' => now()
                    ]);

                // Catat transaksi barang - SESUAI STRUKTUR DATABASE
                DB::table('tbl_transaksi_barang')->insert([
                    'id_barang' => $item['id_barang'],
                    'tipe' => 'keluar',
                    'kuantiti' => $item['quantity'],
                    'stok_sebelum' => $barang->stok_b,
                    'stok_sesudah' => $stokBaru,
                    'desc_tb' => 'Pemesanan #' . $orderId . ' oleh ' . Session::get('user.username'),
                    'id_user' => $userId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Update total price di order (jika ada perubahan harga)
            DB::table('tbl_order')
                ->where('id_order', $orderId)
                ->update([
                    'totalprice' => $totalPrice,
                    'updated_at' => now()
                ]);

            DB::commit();

            // Kosongkan keranjang
            Session::forget('keranjang');

            return redirect()->route('kostumer.riwayat')
                ->with('success', 'Pesanan berhasil dibuat! Nomor Order: #' . $orderId . '. Total: Rp ' . number_format($totalPrice, 0, ',', '.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('kostumer.keranjang')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Halaman Riwayat - HANYA TAMPILKAN ORDER MILIK USER
    public function riwayat()
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $userId = Session::get('user.id_user');

        $orders = DB::table('tbl_order')
            ->where('user_id', '=', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kostumer.riwayat', compact('orders'));
    }

    // Detail Riwayat - VALIDASI KEPEMILIKAN ORDER
    public function detailRiwayat($id)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $userId = Session::get('user.id_user');

        $order = DB::table('tbl_order')
            ->where('id_order', $id)
            ->where('user_id', '=', $userId)
            ->first();

        if (!$order) {
            return redirect()->route('kostumer.riwayat')
                ->with('error', 'Order tidak ditemukan atau Anda tidak memiliki akses ke order ini');
        }

        $orderItems = DB::table('tbl_barang_order')
            ->join('tbl_barang', 'tbl_barang_order.id_barang', '=', 'tbl_barang.id_barang')
            ->join('tbl_kategori', 'tbl_barang_order.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->where('tbl_barang_order.id_order', $id)
            ->select(
                'tbl_barang_order.*',
                'tbl_barang.nama_b',
                'tbl_barang.image_path',
                'tbl_kategori.nama_kategori'
            )
            ->get();

        return view('kostumer.detail_riwayat', compact('order', 'orderItems'));
    }

    // FUNGSI BARU: Generate PDF untuk Order (Hanya 7 hari terakhir)
    public function generatePDF($id)
    {
        $redirect = $this->checkKostumer();
        if ($redirect) return $redirect;

        $userId = Session::get('user.id_user');

        // Ambil order dan validasi kepemilikan
        $order = DB::table('tbl_order')
            ->join('tbl_user', 'tbl_order.user_id', '=', 'tbl_user.id_user')
            ->where('tbl_order.id_order', $id)
            ->where('tbl_order.user_id', '=', $userId)
            ->select('tbl_order.*', 'tbl_user.username', 'tbl_user.email', 'tbl_user.phone')
            ->first();

        if (!$order) {
            return redirect()->route('kostumer.riwayat')
                ->with('error', 'Order tidak ditemukan atau Anda tidak memiliki akses ke order ini');
        }

        // Validasi: Hanya order dalam 7 hari terakhir yang bisa di-download PDF
        $orderDate = Carbon::parse($order->created_at);
        $daysSinceOrder = $orderDate->diffInDays(Carbon::now());

        if ($daysSinceOrder > 7) {
            return redirect()->route('kostumer.riwayat')
                ->with('error', 'PDF hanya tersedia untuk pesanan dalam 7 hari terakhir');
        }

        // Ambil detail items
        $orderItems = DB::table('tbl_barang_order')
            ->join('tbl_barang', 'tbl_barang_order.id_barang', '=', 'tbl_barang.id_barang')
            ->join('tbl_kategori', 'tbl_barang_order.id_kategori', '=', 'tbl_kategori.id_kategori')
            ->where('tbl_barang_order.id_order', $id)
            ->select(
                'tbl_barang_order.*',
                'tbl_barang.nama_b',
                'tbl_kategori.nama_kategori'
            )
            ->get();

        // Generate PDF
        $pdf = PDF::loadView('kostumer.pdf.order', compact('order', 'orderItems'));

        // Download PDF
        return $pdf->download('Invoice-Order-' . $order->id_order . '.pdf');
    }
}
