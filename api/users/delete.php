<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil user_id dari URL
$user_id = $_GET['user_id'] ?? '';

// Validasi
if ($user_id == '') {
    echo json_encode([
        "status" => false,
        "message" => "User ID wajib diisi"
    ]);
    exit;
}

// Query delete
$query = "DELETE FROM users WHERE user_id = '$user_id'";

// Eksekusi
if ($conn->query($query)) {

    echo json_encode([
        "status" => true,
        "message" => "User berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus user"
    ]);

}
?>