<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT * FROM payments";
$result = $conn->query($query);

$data = [];

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Data payments berhasil diambil",
    "data" => $data
]);

?>