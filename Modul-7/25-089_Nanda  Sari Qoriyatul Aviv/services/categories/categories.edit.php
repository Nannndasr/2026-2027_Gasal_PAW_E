<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $category_id = sanitazion($_GET["category_id"]);
  $category_name = trim($_POST["category_name"]);
  $description = trim($_POST["description"]);

  $sql = <<<SQL
    UPDATE categories SET category_name = ?, description = ?
    WHERE category_id = ?;
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$category_name, $description, $category_id]);

  header("Location: /categories");
  exit();
}
