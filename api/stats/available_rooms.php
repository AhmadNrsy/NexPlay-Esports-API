<?php

header("Content-Type: application/json");

include "../../config/database.php";

$query = "SELECT COUNT(*) AS available_rooms
FROM gaming_rooms
WHERE status_room='Available'";

$result = $conn->query($query);
$data = $result->fetch_assoc();

echo json_encode([
    "status" => true,
    "available_rooms" => $data['available_rooms']
]);

?>