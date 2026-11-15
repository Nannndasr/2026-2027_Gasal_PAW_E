<?php

// Validasi format tanggal Y-m-d, kembalikan null jika tidak valid
function parseDate($value)
{
  $date = DateTime::createFromFormat("Y-m-d", (string) $value);
  return ($date && $date->format("Y-m-d") === $value) ? $value : null;
}

// Agregasi peminjaman per tanggal pinjam + ringkasan total pada rentang waktu
function getLoanReport($conn, $mulai, $selesai)
{
  $rekapSQL = <<<SQL
    SELECT
      borrow_date AS tgl,
      COUNT(*) AS total,
      SUM(status = 'dipinjam') AS dipinjam,
      SUM(status = 'dikembalikan') AS dikembalikan
    FROM loans
    WHERE borrow_date BETWEEN ? AND ?
    GROUP BY borrow_date
    ORDER BY borrow_date ASC;
  SQL;

  $summarySQL = <<<SQL
    SELECT
      COUNT(*) AS total,
      COUNT(DISTINCT user_id) AS anggota,
      COUNT(DISTINCT book_id) AS buku
    FROM loans
    WHERE borrow_date BETWEEN ? AND ?;
  SQL;

  $rekap = $conn->prepare($rekapSQL);
  $rekap->execute([$mulai, $selesai]);

  $summary = $conn->prepare($summarySQL);
  $summary->execute([$mulai, $selesai]);

  return [$rekap->fetchAll(), $summary->fetch()];
}