CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

-- 1. Tabel supplier (Master)
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- 2. Tabel barang (Master)
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- 3. Tabel pelanggan (Master)
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- 4. Tabel user (Master)
CREATE TABLE user (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);

-- 5. Tabel transaksi (Master Transaksi)
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- 6. Tabel transaksi_detail (Detail Transaksi)
CREATE TABLE transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- 7. Tabel pembayaran (Transaksi Pembayaran)
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- 1. Input Data Supplier (Master - 5 Data)
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur', '081234567890', 'Surabaya'),
('CV Maju Bersama', '082134567891', 'Bangkalan'),
('PT Distribusi Jaya', '083134567892', 'Malang'),
('Gudang Sembako Bersama', '085134567893', 'Sidoarjo'),
('CV Sentosa Abadi', '087134567894', 'Gresik');

-- 2. Input Data Barang (Master - 5 Data)
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Buku Tulis A5', 5000, 100, 1),
('BRG002', 'Pulpen Gel Black', 3500, 150, 1),
('BRG003', 'Kertas A4 80gr', 45000, 50, 2),
('BRG004', 'Pensil 2B', 2500, 200, 3),
('BRG005', 'Spidol Boardmarker', 8000, 80, 4);

-- 3. Input Data Pelanggan (Master - 5 Data)
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Ahmad Dani', 'L', '081999888777', 'Kamal, Bangkalan'),
('PLG002', 'Siti Nurhaliza', 'P', '082999888777', 'Telang, Bangkalan'),
('PLG003', 'Budi Santoso', 'L', '083999888777', 'Burneh, Bangkalan'),
('PLG004', 'Rina Rose', 'P', '085999888777', 'Socah, Bangkalan'),
('PLG005', 'Dewi Lestari', 'P', '087999888777', 'Kota Bangkalan');

-- 4. Input Data User (Master - 5 Data)
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator Utama', 'Bangkalan', '0811111111', 1),
('kasir1', MD5('kasir123'), 'Siti Kasir', 'Kamal', '0822222222', 2),
('kasir2', MD5('kasir123'), 'Rian Kasir', 'Telang', '0833333333', 2),
('manajer', MD5('manajer123'), 'Bambang Manager', 'Surabaya', '0844444444', 1),
('gudang', MD5('gudang123'), 'Eko Staff Gudang', 'Sidoarjo', '0855555555', 3);

-- 5. Input Data Transaksi (Master Transaksi - 5 Data)
INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-11-01', 'Pembelian alat tulis kantor', 55000, 'PLG001'),
(2, '2026-11-01', 'Pembelian keperluan sekolah', 13000, 'PLG002'),
(3, '2026-11-02', 'Pembelian grosir kertas', 90000, 'PLG003'),
(4, '2026-11-02', 'Pembelian eceran', 21000, 'PLG004'),
(5, '2026-11-03', 'Perlengkapan ujian', 11000, 'PLG005');

-- 6. Input Data Transaksi Detail (10 Data Detail)
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 5000, 2),
(1, 3, 45000, 1),
(2, 2, 3500, 3),
(2, 4, 2500, 1),
(3, 3, 45000, 2),
(4, 5, 8000, 2),
(4, 1, 5000, 1),
(5, 1, 5000, 1),
(5, 2, 3500, 1),
(5, 4, 2500, 1);