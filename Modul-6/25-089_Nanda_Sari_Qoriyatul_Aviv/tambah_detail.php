<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = intval($_POST['transaksi_id']);
    $barang_id    = intval($_POST['barang_id']);
    $qty          = intval($_POST['qty']);

    // 1. Ambil harga barang saat ini dari tabel barang
    $q_harga = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id");
    $data_harga = mysqli_fetch_assoc($q_harga);
    $harga = $data_harga['harga'];

    // 2. Simpan ke tabel transaksi_detail
    $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
                                      VALUES ($transaksi_id, $barang_id, $harga, $qty)");

    if ($insert) {
        // 3. HITUNG ULANG TOTAL TRANSAKSI (Nomor 4)
        // Menjumlahkan seluruh (harga * qty) untuk transaksi_id yang sama
        $q_total = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS grand_total 
                                           FROM transaksi_detail 
                                           WHERE transaksi_id = $transaksi_id");
        $res_total = mysqli_fetch_assoc($q_total);
        $grand_total = $res_total['grand_total'] ? $res_total['grand_total'] : 0;

        // 4. Update kolom total pada tabel transaksi (Nomor 4)
        mysqli_query($koneksi, "UPDATE transaksi SET total = $grand_total WHERE id = $transaksi_id");

        echo "<script>alert('Detail transaksi berhasil ditambahkan!'); window.location='detail_transaksi.php?id=$transaksi_id';</script>";
    } else {
        echo "<script>alert('Gagal menambah detail transaksi!'); window.location='detail_transaksi.php?id=$transaksi_id';</script>";
    }
}
?>