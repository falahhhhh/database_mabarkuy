<?php
header('Content-Type: application/json');
include 'koneksi.php';

if (!isset($_POST['lobby_id']) || !isset($_POST['user_id'])) {
    echo json_encode(["status"=>"failed","message"=>"Parameter lobby_id dan user_id wajib dikirim"]);
    exit;
}

$lobby_id = (int)$_POST['lobby_id'];
$user_id  = (int)$_POST['user_id'];

if ($lobby_id <= 0 || $user_id <= 0) {
    echo json_encode(["status"=>"failed","message"=>"Parameter tidak valid"]);
    exit;
}

// Cek owner lobby
$stmt = mysqli_prepare($conn, "SELECT user_id FROM lobbies WHERE lobby_id = ?");
mysqli_stmt_bind_param($stmt, "i", $lobby_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode(["status"=>"failed","message"=>"Lobby tidak ditemukan"]);
    exit;
}

$row = mysqli_fetch_assoc($res);
$owner_id = (int)$row['user_id'];

if ($owner_id !== $user_id) {
    echo json_encode(["status"=>"failed","message"=>"Akses ditolak: hanya pembuat lobby yang boleh menghapus"]);
    exit;
}

// Hapus
$stmtDel = mysqli_prepare($conn, "DELETE FROM lobbies WHERE lobby_id = ?");
mysqli_stmt_bind_param($stmtDel, "i", $lobby_id);

if (mysqli_stmt_execute($stmtDel)) {
    echo json_encode(["status"=>"success","message"=>"Lobby berhasil dihapus"]);
} else {
    echo json_encode(["status"=>"failed","message"=>"Gagal menghapus lobby"]);
}
?>
