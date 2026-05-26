<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil room_id dari URL
$room_id = $_GET['room_id'] ?? '';

// Validasi
if ($room_id == '') {
    echo json_encode([
        "status" => false,
        "message" => "Room ID wajib diisi"
    ]);
    exit;
}

// Query delete
$query = "DELETE FROM gaming_rooms WHERE room_id = '$room_id'";

// Eksekusi
if ($conn->query($query)) {

    echo json_encode([
        "status" => true,
        "message" => "Gaming room berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus gaming room"
    ]);

}
?>