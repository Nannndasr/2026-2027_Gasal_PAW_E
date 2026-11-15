<?php

$sql = <<<SQL
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
  ORDER BY b.book_id DESC;
SQL;

$bookResults = $conn->query($sql)->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <div class="d-flex justify-content-between align-items-center mb-7">
    <h1 class="mb-0">Buku</h1><a class="btn btn-solid theme-primary" href="/books/add">Tambah buku</a>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ISBN</th>
          <th>Judul</th>
          <th>Penulis</th>
          <th>Penerbit</th>
          <th>Tahun</th>
          <th>Stok</th>
          <th>Kategori</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bookResults as $book): ?>
          <tr>
            <td><?= sanitazion($book["isbn"]) ?></td>
            <td><?= sanitazion($book["title"]) ?></td>
            <td><?= sanitazion($book["author"]) ?></td>
            <td><?= sanitazion($book["publisher"]) ?></td>
            <td><?= sanitazion($book["publication_year"]) ?></td>
            <td><?= sanitazion($book["stock"]) ?></td>
            <td><?= sanitazion($book["category"]) ?></td>
            <td class="text-end"><a class="btn btn-text theme-primary" href="/books/edit?book_id=<?= sanitazion($book["book_id"]) ?>">Ubah</a> <a href="/api/books/delete?book_id=<?= sanitazion($book["book_id"]) ?>"
                class="btn btn-text theme-danger" type="button">Hapus</a></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>