CARA PAKAI
1. Ekstrak folder ke C:\xampp\htdocs\
2. Start Apache + MySQL di XAMPP.
3. phpMyAdmin -> Import -> pilih db.sql  (tabel user lama akan diganti).
4. Buka http://localhost/<nama_folder>/login.php
   Owner : budi / budi123
   Kasir : wati / wati123
5. Kalau login gagal: buka reset_akun.php sekali, lalu coba login lagi.
   Setelah berhasil, HAPUS reset_akun.php.

FILE
koneksi.php  - koneksi database (ubah password MySQL di sini jika perlu)
auth.php     - fungsi proteksi halaman: wajib_login(), wajib_level()
login.php    - form login + set session
logout.php   - hapus session -> login
header.php   - navbar sesuai level;  footer.php - script bawah
index.php    - Home
user.php     - CRUD Data User (owner)
barang.php, supplier.php, pelanggan.php - Data Master (owner), tempel CRUD modul lama
transaksi.php, laporan.php - owner & kasir, tempel isi dari modul lama
