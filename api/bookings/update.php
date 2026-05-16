<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$booking_id = $_POST['booking_id'] ?? '';
$user_id = $_POST['user_id'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$waktu_mulai = $_POST['waktu_mulai'] ?? '';
$durasi_jam = $_POST['durasi_jam'] ?? '';
$total_harga = $_POST['total_harga'] ?? '';
$status_booking = $_POST['status_booking'] ?? '';

// Validasi
if (
    $booking_id == '' ||
    $user_id == '' ||
    $room_id == '' ||
    $waktu_mulai == '' ||
    $durasi_jam == '' ||
    $total_harga == '' ||
    $status_booking == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query update
$query = "UPDATE bookings SET
user_id = '$user_id',
room_id = '$room_id',
waktu_mulai = '$waktu_mulai',
durasi_jam = '$durasi_jam',
total_harga = '$total_harga',
status_booking = '$status_booking'

WHERE booking_id = '$booking_id'";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Booking berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update booking"
    ]);
}

?>