<?php

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // ← Tambahan untuk protect Endpoint ini dengan token

// Validasi token dulu
validate_token($conn);

$query = "SELECT COUNT(*) AS active_bookings 
FROM bookings
WHERE status_booking='Active'";

$result = $conn->query($query);
$data = $result->fetch_assoc();

echo json_encode([
    "status" => true,
    "active_bookings" => $data['active_bookings']
]);

?>