<?php
session_start();
include 'CONFIG1.PHP';
if (!isset($_SESSION['full_name'])) {
    header("Location: lOGIN1.PHP");
    exit();
}

echo "Welcome, " . $_SESSION['full_name'] . "!";
?>

<a href="logout.php">Logout</a>
