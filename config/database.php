<?php

$host = "localhost";
$user = "root";
$password = "Masukkan??Password??kamu";
$database = "db_nexplay_esports";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>