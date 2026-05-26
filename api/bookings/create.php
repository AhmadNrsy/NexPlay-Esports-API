<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

// Ambil data
$user_id = $_POST['user_id'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$waktu_mulai = $_POST['waktu_mulai'] ?? '';
$durasi_jam = $_POST['durasi_jam'] ?? '';
$total_harga = $_POST['total_harga'] ?? '';
$status_booking = $_POST['status_booking'] ?? '';

// Validasi
if (
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

// Query insert
$query = "INSERT INTO bookings
(user_id, room_id, waktu_mulai, durasi_jam, total_harga, status_booking)

VALUES
('$user_id', '$room_id', '$waktu_mulai', '$durasi_jam', '$total_harga', '$status_booking')";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Booking berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan booking"
    ]);
}

?>