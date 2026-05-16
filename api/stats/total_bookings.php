<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT COUNT(*) AS total_bookings FROM bookings";

$result = $conn->query($query);
$data = $result->fetch_assoc();

echo json_encode([
    "status" => true,
    "total_bookings" => $data['total_bookings']
]);

?>