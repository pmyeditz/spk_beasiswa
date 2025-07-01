<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## 🚀 Langkah-langkah Menjalankan Project Laravel: `spk_beasiswa`

### 📥 1. Clone Project dari GitHub

```bash
git clone git@github.com:pmyeditz/spk_beasiswa.git
cd spk_beasiswa
```

### 🛠️ 2. Salin File `.env`

```bash
cp .env.example .env
```

---

### ⚙️ 3. Konfigurasi Database

#### **A. Jika Menggunakan MAMP (MacOS)**

Edit file `.env` dan sesuaikan:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_beasiswa
DB_USERNAME=root
DB_PASSWORD=root
UNIX_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
```

#### **B. Jika Menggunakan XAMPP (Windows/Linux)**

Edit file `.env` dan sesuaikan:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_beasiswa
DB_USERNAME=root
DB_PASSWORD=
DB_SOCKET=
```

---

### 📦 4. Install Dependency Laravel

```bash
composer install
```

---

### 🔑 5. Generate Application Key

```bash
php artisan key:generate
```

---

### 🗃️ 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```

---

### 🧾 7. Install DomPDF (untuk export PDF)

```bash
composer require barryvdh/laravel-dompdf
```

---

### 🚀 8. Jalankan Laravel

```bash
php artisan serve
```

Buka browser dan akses:
👉 `http://localhost:8000`

---

### 🔐 Login Admin

```
Username : admin
Password : admin123
```

## salam hangat RIDHO @anakdesa

