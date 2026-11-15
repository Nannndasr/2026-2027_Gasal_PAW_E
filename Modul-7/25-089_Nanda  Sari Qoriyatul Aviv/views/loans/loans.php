<?php

$sql = <<<SQL
  SELECT
    l.loan_id,
    u.full_name AS member,
    b.title AS book,
    l.borrow_date,
    l.due_date,
    l.return_date,
    l.status
  FROM loans AS l
  JOIN users AS u ON l.user_id = u.user_id
  JOIN books AS b ON l.book_id = b.book_id
  ORDER BY l.loan_id DESC;
SQL;

$loanResults = $conn->query($sql)->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <div class="d-flex justify-content-between align-items-center mb-7">
    <h1 class="mb-0">Peminjaman</h1><a class="btn btn-solid theme-primary" href="/loans/add">Catat peminjaman</a>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Anggota</th>
          <th>Buku</th>
          <th>Tanggal pinjam</th>
          <th>Jatuh tempo</th>
          <th>Tanggal kembali</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($loanResults as $loan): ?>
          <tr>
            <td><?= sanitazion($loan["member"]) ?></td>
            <td><?= sanitazion($loan["book"]) ?></td>
            <td><?= sanitazion($loan["borrow_date"]) ?></td>
            <td><?= sanitazion($loan["due_date"]) ?></td>
            <td><?= sanitazion($loan["return_date"] ?? "-") ?></td>
            <td><span
                class="badge theme-<?= $loan["status"] === "dipinjam" ? "warning" : "success" ?>"><?= sanitazion($loan["status"]) ?></span>
            </td>
            <td class="text-end"><a class="btn btn-text theme-primary"
                href="/loans/edit?loan_id=<?= sanitazion($loan["loan_id"]) ?>">Ubah</a> <a
                class="btn btn-text theme-danger"
                href="/api/loans/delete?loan_id=<?= sanitazion($loan["loan_id"]) ?>">Hapus</a></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>