<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil booking_id dari URL
$booking_id = $_GET['booking_id'] ?? '';

// Validasi
if ($booking_id == '') {
    echo json_encode([
        "status" => false,
        "message" => "Booking ID wajib diisi"
    ]);
    exit;
}

// Query delete
$query = "DELETE FROM bookings WHERE booking_id = '$booking_id'";

// Eksekusi
if ($conn->query($query)) {

    echo json_encode([
        "status" => true,
        "message" => "Booking berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus booking"
    ]);

}
?>