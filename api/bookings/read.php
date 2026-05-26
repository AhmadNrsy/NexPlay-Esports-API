<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

$query = "SELECT * FROM bookings";
$result = $conn->query($query);

$data = [];

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Data bookings berhasil diambil",
    "data" => $data
]);

?>