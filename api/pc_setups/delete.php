<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil pc_id dari URL
$pc_id = $_GET['pc_id'] ?? '';

// Validasi
if ($pc_id == '') {
    echo json_encode([
        "status" => false,
        "message" => "PC ID wajib diisi"
    ]);
    exit;
}

// Query delete
$query = "DELETE FROM pc_setups WHERE pc_id = '$pc_id'";

// Eksekusi
if ($conn->query($query)) {

    echo json_encode([
        "status" => true,
        "message" => "PC setup berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus PC setup"
    ]);

}
?>