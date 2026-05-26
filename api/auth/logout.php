<?php

// ============================================================
// api/auth/logout.php
// Endpoint: POST /api/auth/logout.php
// Header wajib: Authorization: Bearer <token>
//
// Menghapus token dari DB sehingga tidak bisa dipakai lagi
// ============================================================

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";

// Validasi token dulu — juga ambil data admin yang login
$admin = validate_token($conn);

// Hapus token yang sedang dipakai dari DB
$token_header = '';
$headers = getallheaders();
foreach ($headers as $key => $value) {
    if (strtolower($key) === 'authorization') {
        $token_header = trim(substr($value, 7)); // Potong "Bearer "
        break;
    }
}

$token_safe = mysqli_real_escape_string($conn, $token_header);
$query = "DELETE FROM auth_tokens WHERE token = '$token_safe'";
mysqli_query($conn, $query);

http_response_code(200);
echo json_encode([
    "status" => true,
    "message" => "Logout berhasil. Token " . $admin['username'] . " telah dihapus."
]);
