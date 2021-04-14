<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// setcookie('submit', '', time() - 3600);

header("Location: penjual/login.php");
exit;
