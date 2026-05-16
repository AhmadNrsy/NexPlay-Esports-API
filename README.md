# NexPlay Esports API

REST API sederhana untuk manajemen NexPlay Esports Cafe.

## Features
- CRUD Users
- CRUD Gaming Rooms
- CRUD Bookings
- CRUD Payments
- CRUD PC Setups
- Statistik transaksi

## Tech Stack
- PHP Native
- MySQL
- phpMyAdmin
- Postman

## API Endpoints

### Users
- GET /api/users/read.php
- POST /api/users/create.php
- POST /api/users/update.php
- DELETE /api/users/delete.php?user_id=1

### Gaming Rooms
- GET /api/gaming_rooms/read.php
- POST /api/gaming_rooms/create.php
- POST /api/gaming_rooms/update.php
- DELETE /api/gaming_rooms/delete.php?room_id=1

### Payments
- GET /api/payments/read.php
- POST /api/payments/create.php
- POST /api/payments/update.php
- DELETE /api/payments/delete.php?payment_id=1

### PC Setups
- GET /api/pc_setups/read.php
- POST /api/pc_setups/create.php
- POST /api/pc_setups/update.php
- DELETE /api/pc_setups/delete.php?pc_id=1

### Bookings
- GET /api/bookings/read.php
- POST /api/bookings/create.php
- POST /api/bookings/update.php
- DELETE /api/bookings/delete.php?booking_id=1

### Statistics
- GET /api/stats/revenue.php
- GET /api/stats/total_bookings.php
- GET /api/stats/active_bookings.php
- GET /api/stats/available_rooms.php

## Documentation
Dokumentasi API tersedia pada folder:
```text
/docs/tugas7_nexplay_esports_api_collection.json