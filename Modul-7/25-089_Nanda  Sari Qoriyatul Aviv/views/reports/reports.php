<?php

require_once __DIR__ . "/../../services/reports/reports.query.php";

$mulai = parseDate($_GET["mulai"] ?? "");
$selesai = parseDate($_GET["selesai"] ?? "");
$rows = [];
$summary = ["total" => 0, "anggota" => 0, "buku" => 0];

if ($mulai && $selesai) {
  if ($mulai > $selesai) {
    [$mulai, $selesai] = [$selesai, $mulai];
  }
  [$rows, $summary] = getLoanReport($conn, $mulai, $selesai);
}

$labels = array_column($rows, "tgl");
$data = array_map("intval", array_column($rows, "total"));

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">
    Rekap laporan peminjaman
    <?php if ($mulai && $selesai): ?>
      <small class="fs-lg"><?= sanitazion($mulai) ?> sampai <?= sanitazion($selesai) ?></small>
    <?php endif ?>
  </h1>

  <form class="d-print-none mb-7" action="/reports" method="GET">
    <div class="row">
      <div class="md:col-4">
        <div class="form-field mb-5"><label class="form-label" for="mulai">Dari tanggal</label><input class="form-control" type="date" id="mulai" name="mulai" value="<?= sanitazion($mulai ?? "") ?>" required></div>
      </div>
      <div class="md:col-4">
        <div class="form-field mb-5"><label class="form-label" for="selesai">Sampai tanggal</label><input class="form-control" type="date" id="selesai" name="selesai" value="<?= sanitazion($selesai ?? "") ?>" required></div>
      </div>
    </div>
    <button type="submit" class="btn btn-solid theme-primary">Tampilkan</button>
    <?php if ($rows): ?>
      <button type="button" class="btn btn-outline theme-primary" id="btnPrint">Cetak</button>
      <a class="btn btn-outline theme-success" href="/api/reports/export?mulai=<?= sanitazion($mulai) ?>&selesai=<?= sanitazion($selesai) ?>">Excel</a>
    <?php endif ?>
  </form>

  <?php if (!$mulai || !$selesai): ?>
    <div class="alert theme-info" role="alert">Pilih rentang tanggal pinjam untuk menampilkan laporan.</div>
  <?php elseif (!$rows): ?>
    <div class="alert theme-warning" role="alert">Tidak ada peminjaman pada rentang tanggal tersebut.</div>
  <?php else: ?>

    <h2 class="fs-xl mb-5">Grafik peminjaman per hari</h2>
    <div class="mb-7"><canvas id="chartLoans"></canvas></div>

    <h2 class="fs-xl mb-5">Rekapitulasi</h2>
    <div class="table-responsive mb-7">
      <table class="table">
        <thead><tr><th>No</th><th>Tanggal pinjam</th><th>Total peminjaman</th><th>Masih dipinjam</th><th>Sudah dikembalikan</th></tr></thead>
        <tbody>
          <?php foreach ($rows as $i => $row): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= date("d M Y", strtotime($row["tgl"])) ?></td>
              <td><?= sanitazion($row["total"]) ?></td>
              <td><?= sanitazion($row["dipinjam"]) ?></td>
              <td><?= sanitazion($row["dikembalikan"]) ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead><tr><th>Jumlah anggota</th><th>Jumlah buku</th><th>Jumlah peminjaman</th></tr></thead>
        <tbody><tr>
          <td><?= sanitazion($summary["anggota"]) ?> Orang</td>
          <td><?= sanitazion($summary["buku"]) ?> Judul</td>
          <td><?= sanitazion($summary["total"]) ?> Transaksi</td>
        </tr></tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
      new Chart(document.getElementById("chartLoans"), {
        type: "pie",
        data: {
          labels: <?= json_encode($labels) ?>,
          datasets: [{ label: "Total peminjaman", data: <?= json_encode($data) ?> }]
        },
        options: { scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
      });
      document.getElementById("btnPrint").addEventListener("click", () => window.print());
    </script>
  <?php endif ?>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>