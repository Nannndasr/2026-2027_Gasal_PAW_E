<?php

$sql = <<<SQL
  SELECT category_id, category_name, description
  FROM categories
  ORDER BY category_id DESC;
SQL;

$categoryResults = $conn->query($sql)->fetchAll();

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
  <div class="d-flex justify-content-between align-items-center mb-7">
    <h1 class="mb-0">Kategori</h1><a class="btn btn-solid theme-primary" href="/categories/add">Tambah kategori</a>
  </div>
  <?php if (isset($_GET["error"])): ?>
    <div class="alert theme-danger mb-5" role="alert">Kategori tidak bisa dihapus karena masih dipakai oleh buku.</div>
  <?php endif ?>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
            <?php foreach ($categoryResults as $category): ?>
          <tr>
            <td><?= sanitazion($category["category_name"]) ?></td>
            <td><?= sanitazion($category["description"]) ?></td>
            <td class="text-end"><a class="btn btn-text theme-primary"
                href="/categories/edit?category_id=<?= sanitazion($category["category_id"]) ?>">Ubah</a> <a
                class="btn btn-text theme-danger"
                href="/api/categories/delete?category_id=<?= sanitazion($category["category_id"]) ?>">Hapus</a></td>
          </tr>
            <?php endforeach ?>
      </tbody>
    </table>
  </div>

</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>