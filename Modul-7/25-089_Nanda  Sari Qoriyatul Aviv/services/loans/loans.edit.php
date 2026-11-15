<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $loan_id = sanitazion($_GET["loan_id"]);
  $user_id = sanitazion($_POST["user_id"]);
  $book_id = sanitazion($_POST["book_id"]);
  $borrow_date = sanitazion($_POST["borrow_date"]);
  $due_date = sanitazion($_POST["due_date"]);
  $return_date = trim($_POST["return_date"]) === "" ? null : sanitazion($_POST["return_date"]);
  $status = in_array($_POST["status"], ["dipinjam", "dikembalikan"]) ? $_POST["status"] : "dipinjam";

  $sql = <<<SQL
    UPDATE loans SET user_id = ?, book_id = ?, borrow_date = ?, due_date = ?, return_date = ?, status = ?
    WHERE loan_id = ?;
  SQL;

  $res = $conn->prepare($sql);
  $res->execute([$user_id, $book_id, $borrow_date, $due_date, $return_date, $status, $loan_id]);

  header("Location: /loans");
  exit();
}
