<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil data dari form
$user_id = $_POST['user_id'] ?? '';
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$tier_member = $_POST['tier_member'] ?? '';

// Validasi sederhana
if ($user_id == '' || $username == '' || $email == '' || $tier_member == '') {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query update
$query = "UPDATE users 
          SET username='$username',
              email='$email',
              tier_member='$tier_member'
          WHERE user_id='$user_id'";

// Eksekusi query
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "User berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update user"
    ]);
}

?>