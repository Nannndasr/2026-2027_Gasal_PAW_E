<?php

$sql = <<<SQL
  SELECT category_id, category_name FROM categories;
SQL;

$categoryResults = $conn->query($sql)->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">Tambah buku</h1>
  <div class="row">
    <div class="md:col-8 lg:col-6">
      <form action="/api/books/add" method="POST">
        <div class="form-field mb-5"><label class="form-label" for="category_id">Kategori</label><select
            class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categoryResults as $category): ?>
              <option value="<?= $category["category_id"] ?>"><?= $category["category_name"] ?></option>
            <?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="isbn">ISBN</label><input class="form-control"
            type="text" id="isbn" name="isbn" required></div>
        <div class="form-field mb-5"><label class="form-label" for="title">Judul</label><input class="form-control"
            type="text" id="title" name="title" required></div>
        <div class="form-field mb-5"><label class="form-label" for="author">Penulis</label><input class="form-control"
            type="text" id="author" name="author" required></div>
        <div class="form-field mb-5"><label class="form-label" for="publisher">Penerbit</label><input
            class="form-control" type="text" id="publisher" name="publisher"></div>
        <div class="form-field mb-5"><label class="form-label" for="publication_year">Tahun terbit</label><input
            class="form-control" type="number" id="publication_year" name="publication_year"></div>
        <div class="form-field mb-5"><label class="form-label" for="stock">Stok</label><input class="form-control"
            type="number" id="stock" name="stock" required></div>
        <button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text"
          href="/books">Batal</a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>