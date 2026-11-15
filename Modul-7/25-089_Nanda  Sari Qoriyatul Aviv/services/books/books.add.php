<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $category = sanitazion($_POST["category_id"]);
  $isbn = sanitazion($_POST["isbn"]);
  $title = sanitazion($_POST["title"]);
  $author = sanitazion($_POST["author"]);
  $publisher = sanitazion($_POST["publisher"]);
  $publication_year = sanitazion($_POST["publication_year"]);
  $stock = sanitazion($_POST["stock"]);

  $sql = <<<SQL
    INSERT INTO books (category_id, isbn, title, author, publisher, publication_year, stock) VALUES (?, ?, ?, ?, ?, ?, ?)
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$category, $isbn, $title, $author, $publisher, $publication_year, $stock]);

  header("Location: /books");
  exit();
}