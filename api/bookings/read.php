<?php

header("Content-Type: application/json");

include "../../config/database.php";

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