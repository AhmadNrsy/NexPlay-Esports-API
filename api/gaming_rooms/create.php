<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$nama_room = $_POST['nama_room'] ?? '';
$tipe_room = $_POST['tipe_room'] ?? '';
$harga_per_jam = $_POST['harga_per_jam'] ?? '';
$status_room = $_POST['status_room'] ?? '';

// Validasi
if (
    $nama_room == '' ||
    $tipe_room == '' ||
    $harga_per_jam == '' ||
    $status_room == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query insert
$query = "INSERT INTO gaming_rooms
(nama_room, tipe_room, harga_per_jam, status_room)

VALUES
('$nama_room', '$tipe_room', '$harga_per_jam', '$status_room')";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Gaming room berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan gaming room"
    ]);
}

?>