<?php

require_once __DIR__ . "/reports.query.php";

$mulai = parseDate($_GET["mulai"] ?? "");
$selesai = parseDate($_GET["selesai"] ?? "");

if (!$mulai || !$selesai) {
  header("Location: /reports");
  exit();
}

if ($mulai > $selesai) {
  [$mulai, $selesai] = [$selesai, $mulai];
}

[$rows, $summary] = getLoanReport($conn, $mulai, $selesai);

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_peminjaman_{$mulai}_sampai_{$selesai}.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<html>

<head>
  <meta charset="utf-8">
</head>

<body>
  <h3>Rekap Laporan Peminjaman</h3>
  <p>Periode: <?= $mulai ?> sampai <?= $selesai ?></p>
  <table border="1">
    <tr><th>No</th><th>Tanggal pinjam</th><th>Total peminjaman</th><th>Masih dipinjam</th><th>Sudah dikembalikan</th></tr>
    <?php foreach ($rows as $i => $row): ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= $row["tgl"] ?></td>
        <td><?= $row["total"] ?></td>
        <td><?= $row["dipinjam"] ?></td>
        <td><?= $row["dikembalikan"] ?></td>
      </tr>
    <?php endforeach ?>
  </table>
  <br>
  <table border="1">
    <tr><th>Jumlah anggota</th><th>Jumlah buku</th><th>Jumlah peminjaman</th></tr>
    <tr><td><?= $summary["anggota"] ?> Orang</td><td><?= $summary["buku"] ?> Judul</td><td><?= $summary["total"] ?> Transaksi</td></tr>
  </table>
</body>

</html>