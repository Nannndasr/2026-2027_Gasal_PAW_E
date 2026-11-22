<?php
session_start();
$_SESSION = [];       // unset semua data session
session_destroy();    // hancurkan session di server
header('Location: login.php');
exit;
