<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cek user
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if($result && mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
    echo json_encode(["status" => "success", "user" => $data]);
} else {
    echo json_encode(["status" => "failed", "message" => "Login Gagal"]);
}
?>