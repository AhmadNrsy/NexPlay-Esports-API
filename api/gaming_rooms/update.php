<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$room_id = $_POST['room_id'] ?? '';
$nama_room = $_POST['nama_room'] ?? '';
$tipe_room = $_POST['tipe_room'] ?? '';
$harga_per_jam = $_POST['harga_per_jam'] ?? '';
$status_room = $_POST['status_room'] ?? '';

// Validasi
if (
    $room_id == '' ||
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

// Query update
$query = "UPDATE gaming_rooms SET
nama_room = '$nama_room',
tipe_room = '$tipe_room',
harga_per_jam = '$harga_per_jam',
status_room = '$status_room'

WHERE room_id = '$room_id'";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "Gaming room berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update gaming room"
    ]);
}

?>