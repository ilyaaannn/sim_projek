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
    nama_kategori VARCHAR(100) NOT NULL
);

INSERT INTO tbl_kategori (nama_kategori) VALUES
('Elektronik'),
('Pakaian'),
('Peralatan Rumah'),
('Aksesoris'),
('Makanan & Minuman');

CREATE TABLE tbl_barang (
    id_barang INT(4) AUTO_INCREMENT PRIMARY KEY,
    nama_b VARCHAR(150) NOT NULL,
    desc_b TEXT,
    id_kategori INT,
    stok_b INT DEFAULT 0,
    price DECIMAL(12,2) NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES tbl_kategori(id_kategori)
);

INSERT INTO tbl_barang (id_barang, nama_b, desc_b, id_kategori, stok_b, price, image_path, created_at, updated_at) VALUES
('1001','Kipas Angin', 'Kipas angin berkecepatan tinggi', 1, 20, 250000, 'img/kipas.jpg', NOW(), NOW()),
('1002','Kemeja Polos', 'Kemeja formal bahan katun', 2, 35, 150000, 'img/kemeja.jpg', NOW(), NOW()),
('1003','Panci Stainless', 'Panci ukuran 24cm anti karat', 3, 15, 180000, 'img/panci.jpg', NOW(), NOW()),
('1004','Gelang Aesthetic', 'Gelang handmade korea style', 4, 50, 50000, 'img/gelang.jpg', NOW(), NOW()),
('1005','Kopi Arabica', 'Kopi bubuk arabica premium 500gr', 5, 40, 70000, 'img/kopi.jpg', NOW(), NOW());

CREATE TABLE tbl_transaksi_barang (
    id_transb INT(3) AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    tipe ENUM('masuk','keluar') NOT NULL,
    kuantiti INT NOT NULL,
    desc_tb VARCHAR(255),
    user_id INT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_barang) REFERENCES tbl_barang(id_barang),
    FOREIGN KEY (user_id) REFERENCES tbl_user(id_user)
);

INSERT INTO tbl_transaksi_barang (id_transb, id_barang, tipe, kuantiti, desc_tb, user_id, created_at, updated_at) VALUES
(101, 1001, 'masuk', 10, 'Restock barang masuk', 13, NOW(), NOW()),
(102, 1002, 'masuk', 20, 'Stok pakaian baru', 14, NOW(), NOW()),
(103, 1003, 'keluar', 5, 'Barang keluar untuk order #1', 13, NOW(), NOW()),
(104, 1004, 'keluar', 3, 'Digunakan sebagai sample', 14, NOW(), NOW()),
(105, 1005, 'masuk', 15, 'Stok kopi baru datang', 13, NOW(), NOW());

CREATE TABLE tbl_order (
    id_order INT(5) AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('pending','proses','selesai','batal') DEFAULT 'pending',
    totalprice DECIMAL(12,2) DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tbl_user(id_user)
);

INSERT INTO tbl_order (id_order, user_id, status, totalprice, created_at, updated_at) VALUES
(10001, 15, 'pending', 320000, NOW(), NOW()),
(10002, 16, 'proses', 150000, NOW(), NOW()),
(10003, 17, 'selesai', 450000, NOW(), NOW()),
(10004, 15, 'pending', 70000, NOW(), NOW()),
(10005, 16, 'batal', 0, NOW(), NOW());

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
    FOREIGN KEY (id_kategori) REFERENCES tbl_kategori(id_kategori)
);

INSERT INTO tbl_barang_order (id_orderi, id_order, id_barang, id_kategori, kuantiti, price, total) VALUES
(100001, 10001, 1001, 1, 1, 250000, 250000),
(100002, 10001, 1005, 5, 1, 70000, 70000),
(100003, 10002, 1002, 2, 1, 150000, 150000),
(100004, 10003, 1003, 3, 2, 180000, 360000),
(100005, 10004, 1005, 5, 1, 70000, 70000);
