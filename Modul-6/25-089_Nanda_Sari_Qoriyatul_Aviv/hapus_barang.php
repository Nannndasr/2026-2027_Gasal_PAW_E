<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $barang_id = intval($_GET['id']);

    // 1. Cek apakah barang_id ada di tabel transaksi_detail (Nomor 3)
    $cek_relasi = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM transaksi_detail WHERE barang_id = $barang_id");
    $data = mysqli_fetch_assoc($cek_relasi);

    if ($data['jumlah'] > 0) {
        // 2. Jika barang SUDAH DIPAKAI di transaksi -> Batalkan & Tampilkan Alert Notification
        echo "<script>
                alert('Gagal menghapus! Barang ini masih digunakan pada transaksi_detail.');
                window.location='daftar_barang.php';
              </script>";
    } else {
        // 3. Jika BELUM DIPAKAI -> Hapus data barang
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id = $barang_id");
        if ($hapus) {
            echo "<script>
                    alert('Data barang berhasil dihapus!');
                    window.location='daftar_barang.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus barang dari database.');
                    window.location='daftar_barang.php';
                  </script>";
        }
    }
}
?>