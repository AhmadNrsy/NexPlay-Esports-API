<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT * FROM pc_setups";
$result = $conn->query($query);

$data = [];

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Data pc setups berhasil diambil",
    "data" => $data
]);

?>