<?php

// ============================================================
// middleware/auth.php
// ============================================================

function validate_token($conn)
{

    $auth_header = '';

    if (function_exists('getallheaders')) {
        $headers = getallheaders();

        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'authorization') {
                $auth_header = $value;
                break;
            }
        }
    }

    if (empty($auth_header) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $auth_header = $_SERVER['HTTP_AUTHORIZATION'];
    }

    // ── Step 1: Cek header ada atau tidak ──
    if (empty($auth_header)) {
        http_response_code(401);
        echo json_encode([
            "status" => false,
            "message" => "Unauthorized: Token tidak ditemukan. Sertakan header Authorization: Bearer <token>"
        ]);
        exit;
    }

    // ── Step 2: Cek format "Bearer <token>" ──
    // Harus persis: "Bearer " (ada spasi) diikuti token
    if (!str_starts_with($auth_header, 'Bearer ')) {
        http_response_code(401);
        echo json_encode([
            "status" => false,
            "message" => "Unauthorized: Format token salah. Gunakan format 'Bearer <token>'"
        ]);
        exit;
    }

    // Ambil tokennya (potong 7 karakter "Bearer ")
    $token = trim(substr($auth_header, 7));

    if (empty($token)) {
        http_response_code(401);
        echo json_encode([
            "status" => false,
            "message" => "Unauthorized: Token kosong"
        ]);
        exit;
    }

    // ── Step 3 & 4: Cek token di DB + belum expired ──
    // Satu query, efisien
    $token_safe = mysqli_real_escape_string($conn, $token);

    $query = "SELECT t.token_id, t.admin_id, t.expired_at, a.username
               FROM auth_tokens t
               JOIN admin_accounts a ON t.admin_id = a.admin_id
               WHERE t.token = '$token_safe'
               AND t.expired_at > NOW()
               LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        http_response_code(401);
        echo json_encode([
            "status" => false,
            "message" => "Unauthorized: Token tidak valid atau sudah expired. Silakan login ulang."
        ]);
        exit;
    }

    // Token valid! Return data admin.
    $admin = mysqli_fetch_assoc($result);
    return $admin;
}


function generate_token()
{
    return bin2hex(random_bytes(32)); // 32 byte = 64 karakter hex
}
