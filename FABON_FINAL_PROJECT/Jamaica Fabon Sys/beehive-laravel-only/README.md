# BeeHive Restobar - Laravel Only Order & Monitoring System

This version uses **Laravel 11 + Blade only**. There is no React, no Vite frontend folder, and no `npm run dev` step.

## Features

- Customer online ordering page
- Dine-in / take-out checkout
- Available table selection and automatic table occupancy
- Cash or GCash/e-wallet payment details
- Printable digital receipt
- Order tracking page with 5-second auto refresh
- Staff kitchen terminal with 5-second auto refresh
- Admin dashboard for sales, menu, tables, settings, PIN updates, and CSV export

## Default Access Codes

- Staff PIN: `staff123`
- Admin PIN: `admin123`
- Portal: `http://localhost:8000/portal`
- Hidden portal entry: hover the top-left corner of the screen

## Local Run Instructions

### 1. Create the database

Open XAMPP and start **Apache** and **MySQL**.

In phpMyAdmin, create a database named:

```sql
beehive_db
```

### 2. Install Laravel dependencies

Open CMD inside this folder:

```bash
cd beehive-laravel-only
copy .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

### 3. Open the system

Open your browser:

```text
http://localhost:8000
```

That is all. This Laravel-only version does not need `npm install` or `npm run dev`.

## Useful Pages

- Customer order page: `http://localhost:8000`
- Track order: `http://localhost:8000/track`
- Staff/Admin portal: `http://localhost:8000/portal`
- Staff terminal: `http://localhost:8000/staff/orders`
- Admin dashboard: `http://localhost:8000/admin/dashboard`

## Notes

- `vendor/` is not included. Run `composer install` after extracting.
- If migration fails, confirm that MySQL is running and the `beehive_db` database exists.
- Uploaded menu images and GCash QR images are stored as Base64 text in the database.
