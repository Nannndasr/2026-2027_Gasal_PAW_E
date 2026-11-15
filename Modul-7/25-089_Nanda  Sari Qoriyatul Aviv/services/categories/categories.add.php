<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $category_name = trim($_POST["category_name"]);
  $description = trim($_POST["description"]);

  $sql = <<<SQL
    INSERT INTO categories (category_name, description) VALUES (?, ?)
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$category_name, $description]);

  header("Location: /categories");
  exit();
}
