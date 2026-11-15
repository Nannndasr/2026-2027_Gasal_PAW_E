<?php

$category_id = sanitazion($_GET["category_id"]);

$sql = <<<SQL
  DELETE FROM categories
  WHERE category_id = ?;
SQL;

try {
  $res = $conn->prepare($sql);
  $res->execute([$category_id]);
} catch (PDOException $e) {
  // Kategori masih dipakai buku (FK ON DELETE RESTRICT)
  header("Location: /categories?error=in_use");
  exit();
}

header("Location: /categories");
exit();
