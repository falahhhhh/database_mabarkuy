<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mabarkuy";

$conn = mysqli_connect($host, $user, $pass, $db);
header('Content-Type: application/json'); // Agar output selalu JSON
?>