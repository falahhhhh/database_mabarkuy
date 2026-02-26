<?php
include 'koneksi.php';

$query = "SELECT lobbies.*, users.username, users.nickname_game, users.contact_link, users.rank_level, games.game_name 
          FROM lobbies 
          JOIN users ON lobbies.user_id = users.user_id 
          JOIN games ON lobbies.game_id = games.game_id 
          ORDER BY lobbies.created_at DESC";

$result = mysqli_query($conn, $query);
$response = array();

while($row = mysqli_fetch_assoc($result)){
    $response[] = $row;
}
echo json_encode($response);
?>