<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$room_id = $_POST['room_id'] ?? '';
$spek_cpu = $_POST['spek_cpu'] ?? '';
$spek_gpu = $_POST['spek_gpu'] ?? '';
$monitor = $_POST['monitor'] ?? '';

// Validasi
if (
    $room_id == '' ||
    $spek_cpu == '' ||
    $spek_gpu == '' ||
    $monitor == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Query insert
$query = "INSERT INTO pc_setups
(room_id, spek_cpu, spek_gpu, monitor)

VALUES
('$room_id', '$spek_cpu', '$spek_gpu', '$monitor')";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "PC setup berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menambahkan PC setup"
    ]);
}

?>