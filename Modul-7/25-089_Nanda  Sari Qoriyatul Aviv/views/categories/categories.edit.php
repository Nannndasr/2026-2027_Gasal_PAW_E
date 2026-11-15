<?php

$category_id = sanitazion($_GET["category_id"] ?? "");

$sql = <<<SQL
  SELECT category_id, category_name, description
  FROM categories
  WHERE category_id = ?;
SQL;

$category = $conn->prepare($sql);
$category->execute([$category_id]);
$category = $category->fetch();

if (!$category) {
  require_once __DIR__ . "/../404.php";
  return;
}

?>

<?php require_once __DIR__ . "/../partials/header.auth.php" ?>

<main class="container my-9">
<h1 class="mb-7">Edit kategori</h1>
<div class="row"><div class="md:col-8 lg:col-6"><form action="/api/categories/edit?category_id=<?= $category_id ?>" method="POST">
<div class="form-field mb-5"><label class="form-label" for="category_name">Nama kategori</label><input class="form-control" type="text" id="category_name" name="category_name" value="<?= sanitazion($category["category_name"]) ?>" required></div>
<div class="form-field mb-5"><label class="form-label" for="description">Deskripsi</label><textarea class="form-control" id="description" name="description" rows="3"><?= sanitazion($category["description"]) ?></textarea></div>
<button type="submit" class="btn btn-solid theme-primary">Simpan</button> <a class="btn btn-text" href="/categories">Batal</a>
</form></div></div>
</main>

<?php require_once __DIR__ . "/../partials/footer.auth.php" ?>
