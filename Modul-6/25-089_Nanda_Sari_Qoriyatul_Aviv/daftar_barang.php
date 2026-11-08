<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html>
<head><title>Daftar Barang</title></head>
<body>
    <h2>Daftar Barang</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $b['kode_barang']; ?></td>
            <td><?= $b['nama_barang']; ?></td>
            <td>Rp <?= number_format($b['harga']); ?></td>
            <td><?= $b['stok']; ?></td>
            <td>
                <a href="hapus_barang.php?id=<?= $b['id']; ?>" onclick="return confirm('Yakin hapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>