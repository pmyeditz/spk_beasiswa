## 🚀 Langkah-langkah Menjalankan Project Laravel: `spk_beasiswa`

### 📥 1. Clone Project dari GitHub

```bash
git clone git@github.com:pmyeditz/spk_beasiswa.git
```
```bash
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

## salam hangat RIDHO

