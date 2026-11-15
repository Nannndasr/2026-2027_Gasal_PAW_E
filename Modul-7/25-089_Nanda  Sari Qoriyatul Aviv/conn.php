<?php

$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "perpustakaan";

$conn = new PDO("mysql:host=$host:$port;dbname=$database", $username, $password);