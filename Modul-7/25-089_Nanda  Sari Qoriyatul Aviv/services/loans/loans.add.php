<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $user_id = sanitazion($_POST["user_id"]);
  $book_id = sanitazion($_POST["book_id"]);
  $borrow_date = sanitazion($_POST["borrow_date"]);
  $due_date = sanitazion($_POST["due_date"]);
  $return_date = trim($_POST["return_date"]) === "" ? null : sanitazion($_POST["return_date"]);
  $status = in_array($_POST["status"], ["dipinjam", "dikembalikan"]) ? $_POST["status"] : "dipinjam";

  $sql = <<<SQL
    INSERT INTO loans (user_id, book_id, borrow_date, due_date, return_date, status) VALUES (?, ?, ?, ?, ?, ?)
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$user_id, $book_id, $borrow_date, $due_date, $return_date, $status]);

  header("Location: /loans");
  exit();
}
