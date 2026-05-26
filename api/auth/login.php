<?php

// ============================================================
// api/auth/login.php
// Endpoint: POST /api/auth/login.php
//
// Body (form-data atau x-www-form-urlencoded):
//   username = admin
//   password = nexplay123
//
// Response sukses:
//   { "status": true, "message": "...", "token": "...", "expired_at": "..." }
// ============================================================

header("Content-Type: application/json");

include "../../config/database.php";
include "../../middleware/auth.php";  // Untuk generate_token()

// ── Step 1: Hanya terima method POST ──
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method tidak diizinkan. Gunakan POST."
    ]);
    exit;
}

// ── Step 2: Ambil & validasi input ──
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Username dan password wajib diisi"
    ]);
    exit;
}

// ── Step 3: Cari akun di DB ──
// Password di-hash dengan SHA-256 saat disimpan,
// jadi kita hash input-nya juga baru dibandingkan
$username_safe = mysqli_real_escape_string($conn, $username);
$password_hashed = hash('sha256', $password); // SHA-256, konsisten dengan seed SQL

$query = "SELECT admin_id, username
           FROM admin_accounts
           WHERE username = '$username_safe'
           AND password = '$password_hashed'
           LIMIT 1";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    http_response_code(401);
    echo json_encode([
        "status" => false,
        "message" => "Username atau password salah"
    ]);
    exit;
}

$admin = mysqli_fetch_assoc($result);

// ── Step 4: Generate token baru ──
$token = generate_token();                // Dari middleware/auth.php
$expired_at = date('Y-m-d H:i:s', strtotime('+12 hours')); // Expired 12 jam ajah
$admin_id = $admin['admin_id'];

$token_safe = mysqli_real_escape_string($conn, $token);

// ── Step 5: Hapus token lama milik admin ini (opsional, biar tidak numpuk) ──
// Uncomment baris ini kalau mau satu admin = satu token aktif (single session):

    mysqli_query($conn, "DELETE FROM auth_tokens WHERE admin_id = $admin_id");

// ── Step 6: Simpan token ke DB ──
$insert = "INSERT INTO auth_tokens (admin_id, token, expired_at)
           VALUES ($admin_id, '$token_safe', '$expired_at')";

$insert_result = mysqli_query($conn, $insert);

if (!$insert_result) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Gagal menyimpan token. Coba lagi."
    ]);
    exit;
}

// ── Step 7: Response sukses ──
http_response_code(200);
echo json_encode([
    "status" => true,
    "message" => "Login berhasil. Selamat datang, " . $admin['username'] . "!",
    "data" => [
        "token" => $token,
        "expired_at" => $expired_at,
        "note" => "Gunakan token ini di header: Authorization: Bearer <token>"
    ]
]);
