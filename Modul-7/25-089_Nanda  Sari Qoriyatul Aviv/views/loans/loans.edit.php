<?php

$loan_id = sanitazion($_GET["loan_id"] ?? "");

$loan = $conn->prepare("SELECT loan_id, user_id, book_id, borrow_date, due_date, return_date, status FROM loans WHERE loan_id = ?;");
$loan->execute([$loan_id]);
$loan = $loan->fetch();

if (!$loan) {
  require_once __DIR__ . "/../404.php";
  return;
}

// Anggota + peminjam saat ini (jaga-jaga jika perannya bukan anggota)
$users = $conn->prepare("SELECT user_id, full_name FROM users WHERE role = 'anggota' OR user_id = ? ORDER BY full_name;");
$users->execute([$loan["user_id"]]);
$users = $users->fetchAll();
$books = $conn->query("SELECT book_id, title FROM books ORDER BY title;")->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">Edit peminjaman</h1>
  <div class="row">
    <div class="md:col-8 lg:col-6">
      <form action="/api/loans/edit?loan_id=<?= $loan_id ?>" method="POST">
        <div class="form-field mb-5"><label class="form-label" for="user_id">Anggota</label><select class="form-control"
            id="user_id" name="user_id" required><?php foreach ($users as $user): ?>
              <option value="<?= $user["user_id"] ?>" <?= $user["user_id"] == $loan["user_id"] ? "selected" : "" ?>>
                <?= sanitazion($user["full_name"]) ?>
              </option><?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="book_id">Buku</label><select class="form-control"
            id="book_id" name="book_id" required><?php foreach ($books as $book): ?>
              <option value="<?= $book["book_id"] ?>" <?= $book["book_id"] == $loan["book_id"] ? "selected" : "" ?>>
                <?= sanitazion($book["title"]) ?>
              </option><?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="borrow_date">Tanggal pinjam</label><input
            class="form-control" type="date" id="borrow_date" name="borrow_date"
            value="<?= sanitazion($loan["borrow_date"]) ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="due_date">Jatuh tempo</label><input
            class="form-control" type="date" id="due_date" name="due_date" value="<?= sanitazion($loan["due_date"]) ?>"
            required></div>
        <div class="form-field mb-5"><label class="form-label" for="return_date">Tanggal kembali</label><input
            class="form-control" type="date" id="return_date" name="return_date"
            value="<?= sanitazion($loan["return_date"] ?? "") ?>"></div>
        <div class="form-field mb-5"><label class="form-label" for="status">Status</label><select class="form-control"
            id="status" name="status" required>
            <option <?= $loan["status"] === "dipinjam" ? "selected" : "" ?>>dipinjam</option>
            <option <?= $loan["status"] === "dikembalikan" ? "selected" : "" ?>>dikembalikan</option>
          </select></div>
        <button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text"
          href="/loans">Batal</a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>