<?php

try {
  require_once __DIR__ . "/conn.php";
  require_once __DIR__ . "/utils.php";

  $path = $_SERVER['PATH_INFO'] ?? "/";

  switch ($path) {
    case '/':
      require_once __DIR__ . "/views/index.php";
      break;
    case '/login':
      require_once __DIR__ . "/views/login.php";
      break;
    case '/signup':
      require_once __DIR__ . "/views/signup.php";
      break;
    case '/reports':
      require_once __DIR__ . "/views/reports/reports.php";
      break;
    case '/api/reports/export':
      require_once __DIR__ . "/services/reports/reports.export.php";
      break;

    // Books
    case '/books':
      require_once __DIR__ . "/views/books/books.php";
      break;
    case '/books/add':
      require_once __DIR__ . "/views/books/books.form.php";
      break;
    case '/books/edit':
      require_once __DIR__ . "/views/books/books.edit.php";
      break;
    case '/api/books/add':
      require_once __DIR__ . "/services/books/books.add.php";
      break;
    case '/api/books/edit':
      require_once __DIR__ . "/services/books/books.edit.php";
      break;
    case '/api/books/delete':
      require_once __DIR__ . "/services/books/books.delete.php";
      break;

    // Categories
    case '/categories':
      require_once __DIR__ . "/views/categories/categories.php";
      break;
    case '/categories/add':
      require_once __DIR__ . "/views/categories/categories.form.php";
      break;
    case '/categories/edit':
      require_once __DIR__ . "/views/categories/categories.edit.php";
      break;
    case '/api/categories/add':
      require_once __DIR__ . "/services/categories/categories.add.php";
      break;
    case '/api/categories/edit':
      require_once __DIR__ . "/services/categories/categories.edit.php";
      break;
    case '/api/categories/delete':
      require_once __DIR__ . "/services/categories/categories.delete.php";
      break;

    // Loans
    case '/loans':
      require_once __DIR__ . "/views/loans/loans.php";
      break;
    case '/loans/add':
      require_once __DIR__ . "/views/loans/loans.form.php";
      break;
    case '/loans/edit':
      require_once __DIR__ . "/views/loans/loans.edit.php";
      break;
    case '/api/loans/add':
      require_once __DIR__ . "/services/loans/loans.add.php";
      break;
    case '/api/loans/edit':
      require_once __DIR__ . "/services/loans/loans.edit.php";
      break;
    case '/api/loans/delete':
      require_once __DIR__ . "/services/loans/loans.delete.php";
      break;

    default:
      require_once __DIR__ . "/views/404.php";
      break;
  }

  $conn = null;
} catch (PDOException $e) {
  echo $e->getMessage();
}