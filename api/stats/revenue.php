<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT SUM(total_harga) AS total_revenue FROM bookings";

$result = $conn->query($query);
$data = $result->fetch_assoc();

echo json_encode([
    "status" => true,
    "total_revenue" => $data['total_revenue']
]);

?>