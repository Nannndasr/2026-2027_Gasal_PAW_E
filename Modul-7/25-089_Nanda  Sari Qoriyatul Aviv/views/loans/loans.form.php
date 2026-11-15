<?php

$users = $conn->query("SELECT user_id, full_name FROM users WHERE role = 'anggota' ORDER BY full_name;")->fetchAll();
$books = $conn->query("SELECT book_id, title FROM books ORDER BY title;")->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">Catat peminjaman</h1>
  <div class="row">
    <div class="md:col-8 lg:col-6">
      <form action="/api/loans/add" method="POST">
        <div class="form-field mb-5"><label class="form-label" for="user_id">Anggota</label><select class="form-control"
            id="user_id" name="user_id" required><?php foreach ($users as $user): ?>
              <option value="<?= $user["user_id"] ?>"><?= sanitazion($user["full_name"]) ?></option><?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="book_id">Buku</label><select class="form-control"
            id="book_id" name="book_id" required><?php foreach ($books as $book): ?>
              <option value="<?= $book["book_id"] ?>"><?= sanitazion($book["title"]) ?></option><?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="borrow_date">Tanggal pinjam</label><input
            class="form-control" type="date" id="borrow_date" name="borrow_date" required></div>
        <div class="form-field mb-5"><label class="form-label" for="due_date">Jatuh tempo</label><input
            class="form-control" type="date" id="due_date" name="due_date" required></div>
        <div class="form-field mb-5"><label class="form-label" for="return_date">Tanggal kembali</label><input
            class="form-control" type="date" id="return_date" name="return_date"></div>
        <div class="form-field mb-5"><label class="form-label" for="status">Status</label><select class="form-control"
            id="status" name="status" required>
            <option>dipinjam</option>
            <option>dikembalikan</option>
          </select></div>
        <button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text"
          href="/loans">Batal</a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>