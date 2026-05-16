<?php

header("Content-Type: application/json");

include "../../config/database.php";

$username = $_POST['username'];
$email = $_POST['email'];
$tier = $_POST['tier_member'];

$query = "INSERT INTO users (username, email, tier_member)
VALUES ('$username', '$email', '$tier')";

$result = mysqli_query($conn, $query);

if ($result) {
    echo json_encode([
        "status" => true,
        "message" => "User berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan user"
    ]);
}

?>