<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil data
$booking_id = $_POST['booking_id'] ?? '';
$metode_bayar = $_POST['metode_bayar'] ?? '';
$status_bayar = $_POST['status_bayar'] ?? '';

// Validasi
if (
    $booking_id == '' ||
    $metode_bayar == '' ||
    $status_bayar == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query insert
$query = "INSERT INTO payments
(booking_id, metode_bayar, status_bayar)

VALUES
('$booking_id', '$metode_bayar', '$status_bayar')";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Payment berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan payment"
    ]);
}

?>