# 🎮 NexPlay Esports API

REST API sederhana untuk manajemen rental setup gaming dan booking pada NexPlay Esports Cafe.  
Project ini dibuat menggunakan PHP Native dan MySQL dengan sistem autentikasi Bearer Token.

---

# 👨‍💻 Disusun Oleh

- **Nama:** Ahmad Nurdiansyah

---

# 🚀 Features

✅ Authentication Login System  
✅ Bearer Token Authorization  
✅ CRUD Users  
✅ CRUD Gaming Rooms  
✅ CRUD Bookings  
✅ CRUD Payments  
✅ CRUD PC Setups  
✅ Statistik Dashboard API  
✅ Protected API Endpoints

---

# 🛠️ Tech Stack

- PHP Native
- MySQL
- phpMyAdmin
- Apache (XAMPP)
- Postman
- Git & GitHub

---

# 🔐 Authentication System

API menggunakan sistem autentikasi Bearer Token.

## Login Endpoint

```http
POST /api/auth/login.php
```

## Request Body

```json
{
  "username": "admin / ahmaddianaja14@gmail.com",
  "password": "nexplay123"
}
```

## Response

```json
{
  "status": true,
  "message": "Login berhasil",
  "data": {
    "token": "your_token_here"
  }
}
```

---

# 🧩 Cara Menggunakan Token

Tambahkan token pada header request:

```http
Authorization: Bearer your_token_here
```

Semua endpoint API hanya dapat diakses jika token valid.

---

# 📌 API Endpoints

## 👤 Users

- GET `/api/users/read.php`
- POST `/api/users/create.php`
- POST `/api/users/update.php`
- DELETE `/api/users/delete.php?user_id=1`

---

## 🎮 Gaming Rooms

- GET `/api/gaming_rooms/read.php`
- POST `/api/gaming_rooms/create.php`
- POST `/api/gaming_rooms/update.php`
- DELETE `/api/gaming_rooms/delete.php?room_id=1`

---

## 💳 Payments

- GET `/api/payments/read.php`
- POST `/api/payments/create.php`
- POST `/api/payments/update.php`
- DELETE `/api/payments/delete.php?payment_id=1`

---

## 🖥️ PC Setups

- GET `/api/pc_setups/read.php`
- POST `/api/pc_setups/create.php`
- POST `/api/pc_setups/update.php`
- DELETE `/api/pc_setups/delete.php?pc_id=1`

---

## 📅 Bookings

- GET `/api/bookings/read.php`
- POST `/api/bookings/create.php`
- POST `/api/bookings/update.php`
- DELETE `/api/bookings/delete.php?booking_id=1`

---

## 📊 Statistics

- GET `/api/stats/revenue.php`
- GET `/api/stats/total_bookings.php`
- GET `/api/stats/active_bookings.php`
- GET `/api/stats/available_rooms.php`

---

# 🗄️ Database Structure

Database menggunakan MySQL dengan beberapa tabel utama:

- users
- gaming_rooms
- bookings
- payments
- pc_setups
- admin_accounts
- auth_tokens

ERD database tersedia pada folder:

```text
/docs/ERD_NexPlay_Esports.png
```

---

# 📁 API Documentation

Dokumentasi Postman tersedia pada folder:

```text
/docs/tugas7_nexplay_esports_api_collection.json
```

---

# 🧪 Testing Authentication

## ❌ Tanpa Token

Endpoint akan menampilkan:

```json
{
  "status": false,
  "message": "Unauthorized: Token tidak ditemukan."
}
```

## ✅ Dengan Token Valid

Endpoint akan berhasil diakses dan menampilkan data JSON.

---

# 📌 Repository GitHub

🔗 https://github.com/AhmadNrsy/NexPlay-Esports-API

---

# ✅ Kesimpulan

Project NexPlay Esports API berhasil dibuat menggunakan PHP Native dan MySQL dengan implementasi sistem autentikasi Bearer Token untuk melindungi seluruh endpoint API.

Sistem ini mendukung proses CRUD, login authentication, validasi token, serta dokumentasi API menggunakan Postman.
