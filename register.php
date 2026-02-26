<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$nickname = $_POST['nickname'];
$rank     = $_POST['rank'];
$contact  = $_POST['contact'];

// Cek apakah username sudah ada?
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
if(mysqli_num_rows($cek) > 0){
    echo json_encode(["status" => "failed", "message" => "Username sudah dipakai!"]);
} else {
    $query = "INSERT INTO users (username, password, nickname_game, rank_level, contact_link) 
              VALUES ('$username', '$password', '$nickname', '$rank', '$contact')";
    
    if(mysqli_query($conn, $query)){
        echo json_encode(["status" => "success", "message" => "Daftar Berhasil!"]);
    } else {
        echo json_encode(["status" => "failed", "message" => "Gagal Daftar"]);
    }
}
?>