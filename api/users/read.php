<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Data users berhasil diambil",
    "data" => $data
]);

?>