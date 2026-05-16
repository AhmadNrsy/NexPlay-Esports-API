<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT * FROM gaming_rooms";
$result = $conn->query($query);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Data gaming rooms berhasil diambil",
    "data" => $data
]);

?>