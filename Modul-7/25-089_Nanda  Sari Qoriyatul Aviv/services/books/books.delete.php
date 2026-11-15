<?php

$book_id = sanitazion($_GET["book_id"]);

$sql = <<<SQL
  DELETE FROM books
  WHERE book_id = ?;
SQL;

$res = $conn->prepare($sql);
$res->execute([$book_id]);

header("Location: /books");
exit();