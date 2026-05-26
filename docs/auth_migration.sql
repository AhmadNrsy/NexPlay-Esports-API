-- ============================================================
-- NexPlay Esports API - Authentication Migration
-- Tambahkan ke database: db_nexplay_esports
-- ============================================================

-- Tabel admin_accounts: menyimpan kredensial login
-- DIPISAH dari tabel users (users = pelanggan, ini = operator API)
CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `admin_id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `username`    VARCHAR(50)  NOT NULL UNIQUE,
  `password`    VARCHAR(255) NOT NULL COMMENT 'Disimpan dalam format SHA-256',
  `created_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel auth_tokens: menyimpan token aktif per sesi login
-- Relasi: satu admin bisa punya banyak token (multi-device)
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `token_id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `admin_id`    INT(11)      NOT NULL,
  `token`       VARCHAR(64)  NOT NULL UNIQUE COMMENT 'Random hex 32 byte = 64 karakter',
  `expired_at`  DATETIME     NOT NULL COMMENT 'Token expired setelah 24 jam',
  `created_at`  DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`token_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `auth_tokens_ibfk_1`
    FOREIGN KEY (`admin_id`) REFERENCES `admin_accounts` (`admin_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Seed: akun admin default untuk testing
-- Password: nexplay123  (SHA-256)
-- ============================================================
INSERT INTO `admin_accounts` (`username`, `password`) VALUES
('admin', SHA2('nexplay123', 256));

-- ============================================================
-- RELASI ANTAR TABEL AUTH
--
--  admin_accounts          auth_tokens
--  ─────────────           ───────────────
--  admin_id  ──────────►  admin_id  (FK)
--  username                token
--  password                expired_at
--  created_at              created_at
--
-- Penjelasan:
-- • admin_accounts  = "siapa yang boleh login"
-- • auth_tokens     = "bukti dia sudah login & kapan kadaluarsa"
-- • Relasi 1-to-many: 1 admin bisa punya N token aktif
-- • ON DELETE CASCADE: admin dihapus → semua tokennya ikut terhapus
-- ============================================================
