<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Installation Guide

---

## 1. Clone Repository

```bash
git clone https://github.com/yourusername/tmdb-dashboard.git
cd tmdb-dashboard
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Frontend Dependencies

```bash
npm install
```

---

## 4. Setup Environment File

Copy the environment file:

```bash
cp .env.example .env
```

---

## 5. Configure Database

Create a new database manually in MySQL, then update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---

## 6. Configure TMDb API Key

Add your TMDb API key in `.env`:

```env
TMDB_API_KEY=
TMDB_BASE_URL=
```
https://www.themoviedb.org/settings/api
---

## 7. Generate Application Key

```bash
php artisan key:generate
```

---

## 8. Run Database Migration

```bash
php artisan migrate
```

---

## 9. Run Frontend (Vite)

```bash
npm run dev
```

---

## 10. Run Laravel Server

```bash
php artisan serve
```

---

## 11. Open Application

Open in your browser:

```
http://127.0.0.1:8000
```
