<?php
include 'koneksi.php';

// Ambil ID Transaksi dari URL, misal: detail_transaksi.php?id=1
$transaksi_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// 1. Ambil data master transaksi
$query_trans = mysqli_query($koneksi, "SELECT t.*, p.nama AS nama_pelanggan 
                                       FROM transaksi t 
                                       LEFT JOIN pelanggan p ON t.pelanggan_id = p.id 
                                       WHERE t.id = $transaksi_id");
$transaksi = mysqli_fetch_assoc($query_trans);

// 2. Ambil list barang_id yang SUDAH ADA di transaksi ini (untuk validasi dropdown)
$query_existing = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
$existing_barang = [];
while ($row = mysqli_fetch_assoc($query_existing)) {
    $existing_barang[] = $row['barang_id'];
}

// 3. Ambil semua data barang dari database
$query_barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Detail Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        table, th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .card { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .btn { padding: 8px 12px; background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Detail Transaksi (Master-Detail)</h2>

    <!-- Data Master Transaksi -->
    <div class="card">
        <h3>Info Transaksi #<?= $transaksi['id']; ?></h3>
        <p><strong>Tanggal:</strong> <?= $transaksi['waktu_transaksi']; ?></p>
        <p><strong>Pelanggan:</strong> <?= $transaksi['nama_pelanggan']; ?></p>
        <p><strong>Keterangan:</strong> <?= $transaksi['keterangan']; ?></p>
        <p><strong>Total Transaksi:</strong> Rp <?= number_format($transaksi['total'], 0, ',', '.'); ?></p>
    </div>

    <!-- Form Input Detail Transaksi (Nomor 2 & 4) -->
    <div class="card">
        <h3>Tambah Barang ke Detail Transaksi</h3>
        <form action="tambah_detail.php" method="POST">
            <input type="hidden" name="transaksi_id" value="<?= $transaksi_id; ?>">
            
            <label>Pilih Barang:</label>
            <select name="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                <?php while ($b = mysqli_fetch_assoc($query_barang)): ?>
                    <?php 
                        // Cek apakah barang sudah diinput di transaksi ini
                        $is_selected = in_array($b['id'], $existing_barang);
                    ?>
                    <!-- Jika sudah diinput, set disabled dan tandai (Nomor 2) -->
                    <option value="<?= $b['id']; ?>" <?= $is_selected ? 'disabled style="color: #aaa;"' : ''; ?>>
                        <?= $b['kode_barang']; ?> - <?= $b['nama_barang']; ?> (Rp <?= number_format($b['harga']); ?>)
                        <?= $is_selected ? ' -- [Sudah Ada]' : ''; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Qty:</label>
            <input type="number" name="qty" min="1" value="1" required>

            <button type="submit" class="btn">Simpan Detail</button>
        </form>
    </div>

    <!-- Tabel Detail Barang -->
    <h3>Daftar Barang dalam Transaksi Ini</h3>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_detail = mysqli_query($koneksi, "SELECT td.*, b.kode_barang, b.nama_barang 
                                                     FROM transaksi_detail td 
                                                     JOIN barang b ON td.barang_id = b.id 
                                                     WHERE td.transaksi_id = $transaksi_id");
            while ($d = mysqli_fetch_assoc($query_detail)):
                $subtotal = $d['harga'] * $d['qty'];
            ?>
            <tr>
                <td><?= $d['kode_barang']; ?></td>
                <td><?= $d['nama_barang']; ?></td>
                <td>Rp <?= number_format($d['harga']); ?></td>
                <td><?= $d['qty']; ?></td>
                <td>Rp <?= number_format($subtotal); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>