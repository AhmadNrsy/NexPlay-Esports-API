<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$payment_id = $_POST['payment_id'] ?? '';
$booking_id = $_POST['booking_id'] ?? '';
$metode_bayar = $_POST['metode_bayar'] ?? '';
$status_bayar = $_POST['status_bayar'] ?? '';

// Validasi
if (
    $payment_id == '' ||
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

// Query update
$query = "UPDATE payments SET
booking_id = '$booking_id',
metode_bayar = '$metode_bayar',
status_bayar = '$status_bayar'

WHERE payment_id = '$payment_id'";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Payment berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update payment"
    ]);
}

?>