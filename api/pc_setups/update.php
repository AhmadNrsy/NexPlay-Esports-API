<?php

header("Content-Type: application/json");

include "../../config/database.php";

// Ambil data
$pc_id = $_POST['pc_id'] ?? '';
$room_id = $_POST['room_id'] ?? '';
$spek_cpu = $_POST['spek_cpu'] ?? '';
$spek_gpu = $_POST['spek_gpu'] ?? '';
$monitor = $_POST['monitor'] ?? '';

// Validasi
if (
    $pc_id == '' ||
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

// Query update
$query = "UPDATE pc_setups SET
room_id = '$room_id',
spek_cpu = '$spek_cpu',
spek_gpu = '$spek_gpu',
monitor = '$monitor'

WHERE pc_id = '$pc_id'";

// Eksekusi
if ($conn->query($query)) {
    echo json_encode([
        "status" => true,
        "message" => "PC setup berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal update PC setup"
    ]);
}

?>