<?php
include 'koneksi.php';

$user_id = $_POST['user_id'];
$game_id = $_POST['game_id'];
$title   = $_POST['title'];
$desc    = $_POST['description'];

$query = "INSERT INTO lobbies (user_id, game_id, title, description) VALUES ('$user_id', '$game_id', '$title', '$desc')";

if(mysqli_query($conn, $query)){
    echo json_encode(["status" => "success", "message" => "Room berhasil dibuat!"]);
} else {
    echo json_encode(["status" => "failed", "message" => "Gagal buat room"]);
}
?>