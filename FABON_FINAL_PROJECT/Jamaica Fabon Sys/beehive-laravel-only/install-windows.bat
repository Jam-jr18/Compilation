@echo off
cd /d %~dp0
if not exist .env copy .env.example .env
composer install
php artisan key:generate
php artisan migrate:fresh --seed
pause
