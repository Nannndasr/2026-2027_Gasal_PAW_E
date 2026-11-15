<?php

$book_id = sanitazion($_GET["book_id"]);

$bookSQL= <<<SQL
  SELECT
    b.book_id,
    b.isbn,
    b.title,
    b.author,
    b.publisher,
    b.publication_year,
    b.stock,
    c.category_name AS category
  FROM books AS b
  JOIN categories AS c ON b.category_id = c.category_id
  WHERE b.book_id = ?;
SQL;

$categorySQL = <<<SQL
  SELECT category_id, category_name FROM categories;
SQL;

$book = $conn->prepare($bookSQL);
$book->execute([$book_id]);
$book = $book->fetch();

$categories = $conn->query($categorySQL)->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <h1 class="mb-7">Edit buku</h1>
  <div class="row">
    <div class="md:col-8 lg:col-6">
      <form action="/api/books/edit?book_id=<?= $book_id ?>" method="POST">
        <div class="form-field mb-5"><label class="form-label" for="category_id">Kategori</label><select
            class="form-control" id="category_id" name="category_id" required>
            <?php foreach ($categories as $c): ?>
              <option value="<?= $c["category_id"] ?>"><?= $c["category_name"] ?></option>
            <?php endforeach ?>
          </select></div>
        <div class="form-field mb-5"><label class="form-label" for="isbn">ISBN</label><input class="form-control"
            type="text" id="isbn" name="isbn" value="<?= $book['isbn'] ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="title">Judul</label><input class="form-control"
            type="text" id="title" name="title" value="<?= $book['title'] ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="author">Penulis</label><input class="form-control"
            type="text" id="author" name="author" value="<?= $book['author'] ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="publisher">Penerbit</label><input
            class="form-control" type="text" id="publisher" name="publisher" value="<?= $book['publisher'] ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="publication_year">Tahun terbit</label><input
            class="form-control" type="number" id="publication_year" name="publication_year" value="<?= $book['publication_year'] ?>" required></div>
        <div class="form-field mb-5"><label class="form-label" for="stock">Stok</label><input class="form-control"
            type="number" id="stock" name="stock" value="<?= $book['stock'] ?>" required></div>
        <button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text"
          href="/books">Batal</a>
      </form>
    </div>
  </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>