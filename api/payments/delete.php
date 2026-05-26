<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil payment_id dari URL
$payment_id = $_GET['payment_id'] ?? '';

// Validasi
if ($payment_id == '') {
    echo json_encode([
        "status" => false,
        "message" => "Payment ID wajib diisi"
    ]);
    exit;
}

// Query delete
$query = "DELETE FROM payments WHERE payment_id = '$payment_id'";

// Eksekusi
if ($conn->query($query)) {

    echo json_encode([
        "status" => true,
        "message" => "Payment berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus payment"
    ]);

}
?>