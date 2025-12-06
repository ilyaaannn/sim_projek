use projec_sim;

CREATE TABLE tbl_user (
    id_user INT(2) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    level CHAR(10) NOT NULL CHECK (level IN ('kostumer' , 'admin', 'staff')),
    alamat VARCHAR(200) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(20) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into tbl_user (id_user, username, level, alamat, phone, email, password, created_at, updated_at) values
(11, 'ilyan', 'admin', 'duri', '8318445', 'ilyanadmin@gmail.com', 'ilyanadmin', NOW(), NOW()),
(12, 'farid', 'admin', 'pakning', '8526415', 'faridadmin@gmail.com', 'faridadmin', NOW(), NOW()),
(13, 'lina', 'staff', 'bengkalis', '8238635', 'linastaff@gmail.com', 'linastaff', NOW(), NOW()),
(14, 'petra', 'staff', 'rohul', '8127015', 'petrastaff@gmail.com', 'petrastaff', NOW(), NOW()),
(15, 'linda', 'kostumer', 'bengkalis', '8518450', 'lindakostumer@gmail.com', 'lindakostumer', NOW(), NOW()),
(16, 'noufan', 'kostumer', 'bengkalis', '8137238', 'noufankostumer@gmail.com', 'noufankostumer', NOW(), NOW()),
(17, 'nazril', 'kostumer', 'sumbar', '8576246', 'nazrilkostumer@gmail.com', 'nazrilkostumer', NOW(), NOW());

CREATE TABLE tbl_kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    gambar_path VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO tbl_kategori (id_kategori, nama_kategori, deskripsi, gambar_path, created_at, updated_at) VALUES
(1, 'Elektronik', 'Perangkat elektronik berkualitas untuk kebutuhan rumah dan aktivitas sehari-hari.', 'img/elektronik.jpg', NOW(), NOW()),
(2, 'Pakaian', 'Pilihan pakaian dengan bahan nyaman dan kualitas terbaik.', 'img/pakaian.jpg', NOW(), NOW()),
(3, 'Peralatan Rumah', 'Perlengkapan rumah tangga fungsional dan tahan lama.', 'img/peralatan_rumah.jpg', NOW(), NOW()),
(4, 'Aksesoris', 'Aksesoris stylish yang membuat penampilan semakin menarik.', 'img/aksesoris.jpg', NOW(), NOW()),
(5, 'Makanan & Minuman', 'Produk makanan dan minuman yang aman, berkualitas, dan lezat.', 'img/makanan_minuman.jpg', NOW(), NOW()),
(6, 'Kerajinan Tangan', 'Kerajinan rotan, pandan, bambu, dan karya lokal Bengkalis yang memiliki nilai seni tinggi.', 'img/kerajinan_tangan.jpg', NOW(), NOW()),
(7, 'Produk Laut', 'Hasil olahan laut Bengkalis seperti ikan, kerupuk basah, dan makanan berbahan tenggiri.', 'img/produk_laut.jpg', NOW(), NOW()),
(8, 'Herbal & Produk Alam', 'Produk alami seperti madu hutan, gula aren, dan herbal lokal dari UMKM Bengkalis.', 'img/herbal_alami.jpg', NOW(), NOW()),
(9, 'Oleh-oleh Khas Bengkalis', 'Aneka oleh-oleh khas daerah seperti kue bangkit, dodol, dan makanan tradisional lainnya.', 'img/oleh_oleh.jpg', NOW(), NOW());

CREATE TABLE tbl_barang (
    id_barang INT(4) AUTO_INCREMENT PRIMARY KEY,
    nama_b VARCHAR(150) NOT NULL,
    desc_b TEXT,
    id_kategori INT,
    stok_b INT not null DEFAULT 0,
    price DECIMAL(12,2) NOT NULL,
    image_path VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES tbl_kategori(id_kategori)
);

INSERT INTO tbl_barang (id_barang, nama_b, desc_b, id_kategori, stok_b, price, image_path, status, created_at, updated_at) VALUES
(1001, 'Powerbank Portable', 'Power bank kapasitas 10000mAh', 1, 25, 150000, 'img/powerbank.jpg', 'active', NOW(), NOW()),
(1002, 'Lampu LED Bambu', 'Lampu hias LED dengan rangkaian bambu hasil kerajinan lokal', 1, 15, 120000, 'img/lampu_bambu.jpg', 'active', NOW(), NOW()),
(1003, 'Radio Kayu Tradisional', 'Radio dengan casing kayu ukiran khas', 1, 10, 350000, 'img/radio_kayu.jpg', 'active', NOW(), NOW()),
(1004, 'Baju Kurung Melayu', 'Baju kurung dengan motif songket asli Bengkalis', 2, 30, 250000, 'img/baju_kurung.jpg', 'active', NOW(), NOW()),
(1005, 'Selendang Tenun Siak', 'Selendang tenun khas Siak dengan warna tradisional', 2, 20, 180000, 'img/selendang_tenun.jpg', 'active', NOW(), NOW()),
(1006, 'Tikar Pandan Anyaman', 'Tikar anyaman pandan tradisional untuk ruang tamu', 3, 40, 95000, 'img/tikar_pandan.jpg', 'active', NOW(), NOW()),
(1007, 'Baskom Rotan', 'Tempat buah atau makanan terbuat dari rotan kualitas terbaik', 3, 35, 65000, 'img/baskom_rotan.jpg', 'active', NOW(), NOW()),
(1008, 'Gelang Manik-manik Melayu', 'Gelang tradisional dari manik-manik warna warni', 4, 60, 45000, 'img/gelang_manik.jpg', 'active', NOW(), NOW()),
(1009, 'Brokat Songket Mini', 'Brokat kecil motif songket untuk hijab atau baju', 4, 70, 35000, 'img/brokat_songket.jpg', 'active', NOW(), NOW()),
(1010, 'Kerupuk Basah Tenggiri', 'Kerupuk basah khas Bengkalis dengan ikan tenggiri pilihan', 5, 100, 35000, 'img/kerupuk_basah.jpg', 'active', NOW(), NOW()),
(1011, 'Dodol Nenas Bengkalis', 'Dodol dengan rasa nenas khas pulau Bengkalis', 5, 80, 40000, 'img/dodol_nenas.jpg', 'active', NOW(), NOW()),
(1012, 'Madu Hutan Riau', 'Madu alami dari hutan tropis Riau', 5, 40, 120000, 'img/madu_riau.jpg', 'active', NOW(), NOW()),
(1013, 'Tas Anyaman Pandan', 'Tas wanita anyaman pandan dengan motif tradisional', 6, 25, 150000, 'img/tas_pandan.jpg', 'active', NOW(), NOW()),
(1014, 'Vas Bunga Rotan', 'Vas bunga dengan anyaman rotan halus', 6, 30, 85000, 'img/vas_rotan.jpg', 'active', NOW(), NOW()),
(1015, 'Topi Bambu Tenun', 'Topi anyaman bambu dengan pita tenun khas', 6, 40, 95000, 'img/topi_bambu.jpg', 'active', NOW(), NOW()),
(1016, 'Ikan Tenggiri Asap', 'Ikan tenggiri asap khas Bengkalis, siap masak', 7, 50, 65000, 'img/tenggiri_asap.jpg', 'active', NOW(), NOW()),
(1017, 'Abon Ikan Kakap', 'Abon ikan kakap khas pulau Bengkalis', 7, 45, 45000, 'img/abon_kakap.jpg', 'active', NOW(), NOW()),
(1018, 'Kerupuk Ikan Belida', 'Kerupuk kering dari ikan belida khas sungai Riau', 7, 75, 30000, 'img/kerupuk_belida.jpg', 'active', NOW(), NOW()),
(1019, 'Gula Aren Asli', 'Gula aren murni dari pohon aren Bengkalis', 8, 60, 35000, 'img/gula_aren.jpg', 'active', NOW(), NOW()),
(1020, 'Minyak Kelapa Murni', 'Minyak kelapa tradisional hasil olahan UMKM', 8, 40, 55000, 'img/minyak_kelapa.jpg', 'active', NOW(), NOW()),
(1021, 'Rempah-rempah Melayu', 'Rempah racikan tradisional untuk masakan Melayu', 8, 55, 25000, 'img/rempah_melayu.jpg', 'active', NOW(), NOW()),
(1022, 'Kue Bangkit Bengkalis', 'Kue tradisional khas Bengkalis yang renyah', 9, 90, 30000, 'img/kue_bangkit.jpg', 'active', NOW(), NOW()),
(1023, 'Sirup Markisa Bengkalis', 'Sirup markisa alami tanpa pengawet', 9, 50, 40000, 'img/sirup_markisa.jpg', 'active', NOW(), NOW());

CREATE TABLE tbl_transaksi_barang (
    id_transb INT(3) AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    tipe ENUM('masuk','keluar') NOT NULL,
    kuantiti INT NOT NULL,
    stok_sebelum INT NOT NULL,
    stok_sesudah INT NOT NULL,
    desc_tb TEXT,
    id_user INT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES tbl_barang(id_barang),
    FOREIGN KEY (id_user) REFERENCES tbl_user(id_user)
);

INSERT INTO tbl_transaksi_barang (id_transb, id_barang, tipe, kuantiti, stok_sebelum, stok_sesudah, desc_tb, id_user, created_at, updated_at) VALUES
(101, 1001, 'masuk', 10, 15, 25, 'Restock dari supplier lokal', 11, NOW(), NOW()),
(102, 1001, 'keluar', 3, 25, 22, 'Pesanan dari pelanggan UMKM', 12, NOW(), NOW()),
(103, 1010, 'masuk', 50, 50, 100, 'Produksi baru dari nelayan lokal', 14, NOW(), NOW()),
(104, 1010, 'keluar', 15, 100, 85, 'Pesanan grosir untuk toko oleh-oleh', 13, NOW(), NOW()),
(105, 1022, 'masuk', 30, 60, 90, 'Produksi harian kue tradisional', 11, NOW(), NOW()),
(106, 1022, 'keluar', 10, 90, 80, 'Pesanan untuk acara adat', 12, NOW(), NOW()),
(107, 1016, 'masuk', 25, 25, 50, 'Hasil olahan ikan tenggiri segar', 14, NOW(), NOW()),
(108, 1016, 'keluar', 8, 50, 42, 'Pesanan katering hotel', 13, NOW(), NOW()),
(109, 1019, 'masuk', 40, 20, 60, 'Panen gula aren dari petani lokal', 11, NOW(), NOW()),
(110, 1019, 'keluar', 12, 60, 48, 'Pesanan toko herbal', 12, NOW(), NOW());

CREATE TABLE tbl_order (
    id_order INT(5) AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('pending','proses','selesai','batal') DEFAULT 'pending',
    totalprice DECIMAL(12,2) DEFAULT 0,
    alamat_pengiriman TEXT NOT NULL,
    catatan TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tbl_user(id_user)
);

INSERT INTO tbl_order (id_order, user_id, status, totalprice, alamat_pengiriman, catatan, created_at, updated_at) VALUES
(10001, 14, 'pending', 0, 'Jl. Sultan Syarif Kasim No. 15, Bengkalis', 'Harap dikemas dengan baik', NOW(), NOW()),
(10002, 11, 'proses', 545000, 'Jl. Bantan No. 8, Kel. Bantan, Bengkalis', 'Kirim sebelum jam 3 sore', NOW(), NOW()),
(10003, 17, 'selesai', 385000, 'Jl. Raja Ali Haji No. 22, Bengkalis', 'Sudah lunas, terima kasih', NOW(), NOW()),
(10004, 16, 'batal', 120000, 'Jl. Lintas Sumatera KM. 5, Bengkalis', 'Pembeli membatalkan pesanan', NOW(), NOW()),
(10005, 15, 'selesai', 275000, 'Jl. Pasar Ikan No. 3, Bengkalis', 'Mohon receipt dimasukkan', NOW(), NOW());

CREATE TABLE tbl_barang_order (
    id_orderi INT(6) AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL,
    id_barang INT NOT NULL,
    id_kategori INT,
    kuantiti INT NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    total DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (id_order) REFERENCES tbl_order(id_order),
    FOREIGN KEY (id_barang) REFERENCES tbl_barang(id_barang),
    FOREIGN KEY (id_kategori) REFERENCES tbl_kategori(id_kategori),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO tbl_barang_order (id_orderi, id_order, id_barang, id_kategori, kuantiti, price, total, created_at, updated_at) VALUES
(1000001, 10001, 1010, 5, 3, 35000, 105000, NOW(), NOW()),
(1000002, 10001, 1022, 9, 2, 30000, 60000, NOW(), NOW()),
(1000003, 10002, 1004, 2, 1, 250000, 250000, NOW(), NOW()),
(1000004, 10002, 1010, 5, 5, 35000, 175000, NOW(), NOW()),
(1000005, 10002, 1022, 9, 4, 30000, 120000, NOW(), NOW()),
(1000006, 10003, 1006, 3, 2, 95000, 190000, NOW(), NOW()),
(1000007, 10003, 1019, 8, 3, 35000, 105000, NOW(), NOW()),
(1000008, 10003, 1020, 8, 2, 55000, 110000, NOW(), NOW()),
(1000009, 10004, 1012, 5, 1, 120000, 120000, NOW(), NOW()),
(1000010, 10005, 1015, 6, 1, 95000, 95000, NOW(), NOW()),
(1000011, 10005, 1021, 8, 2, 25000, 50000, NOW(), NOW());
