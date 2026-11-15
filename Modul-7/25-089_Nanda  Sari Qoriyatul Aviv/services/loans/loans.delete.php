<?php

$loan_id = sanitazion($_GET["loan_id"]);

$sql = <<<SQL
  DELETE FROM loans
  WHERE loan_id = ?;
SQL;

$res = $conn->prepare($sql);
$res->execute([$loan_id]);

header("Location: /loans");
exit();
