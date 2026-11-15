<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $book_id = sanitazion($_GET["book_id"]);
  $category = sanitazion($_POST["category_id"]);
  $isbn = sanitazion($_POST["isbn"]);
  $title = sanitazion($_POST["title"]);
  $author = sanitazion($_POST["author"]);
  $publisher = sanitazion($_POST["publisher"]);
  $publication_year = sanitazion($_POST["publication_year"]);
  $stock = sanitazion($_POST["stock"]);

  $sql = <<<SQL
    UPDATE books SET category_id = ?, isbn = ?, title = ?, author = ?, publisher = ?, publication_year = ?, stock = ?
    WHERE book_id = ?;
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$category, $isbn, $title, $author, $publisher, $publication_year, $stock, $book_id]);

  header("Location: /books");
  exit();
}