# 🚀 Panduan Menjalankan Project Laravel: `spk_beasiswa`

---

## 📥 1. Clone Project dari GitHub link https://drive.google.com/drive/folders/13zu5TOoEEXprRP4To9NYUSnqZe_6UNBz?usp=drive_link

```bash
git clone git@github.com:pmyeditz/spk_beasiswa.git
```
```bash
cd spk_beasiswa
```
---

## 🛠️ 2. Salin File `.env`

```bash
cp .env.example .env
```

---

## ⚙️ 3. Konfigurasi Database

### 🔵 A. Jika Menggunakan MAMP (MacOS)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_beasiswa
DB_USERNAME=root
DB_PASSWORD=root
UNIX_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
```

### 🟠 B. Jika Menggunakan XAMPP (Windows/Linux)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_beasiswa
DB_USERNAME=root
DB_PASSWORD=
DB_SOCKET=
```

---

## 📧 4. Konfigurasi Gmail SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=ridhoae0106@gmail.com
MAIL_PASSWORD="ohal wpta vsrv cxky"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=ridhoae0106@gmail.com
MAIL_FROM_NAME="SistemRawatInap"
```

### ⚠️ Catatan:

* `MAIL_PASSWORD` adalah **App Password Gmail**, bukan password login biasa.
* Aktifkan **2-Step Verification** dan buat App Password melalui:
  👉 [https://myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)

---

## ✉️ 5. Menambahkan Akun Gmail Lain

Jika ingin menggunakan email Gmail lain sebagai pengirim:

### ✅ Langkah-langkah:

1. Aktifkan **2-Step Verification** di akun Gmail:
   [https://myaccount.google.com/security](https://myaccount.google.com/security)
2. Akses halaman:
   [https://myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
3. Pilih:

   * **App**: Mail
   * **Device**: Other → beri nama (misal: `LaravelApp`)
4. Klik **Generate**, lalu salin 16 digit App Password

### 🔧 Update konfigurasi `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=akunlain@gmail.com
MAIL_PASSWORD="abcd efgh ijkl mnop"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=akunlain@gmail.com
MAIL_FROM_NAME="NamaPengirimBaru"
```

### 🔄 Refresh Konfigurasi:

```bash
php artisan config:clear
php artisan config:cache
```

---

## 📦 6. Install Dependency Laravel

```bash
composer install
```

---

## 🔑 7. Generate Application Key

```bash
php artisan key:generate
```

---

## 🗃️ 8. Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

---

## 🧾 9. Install DomPDF (untuk export PDF)

```bash
composer require barryvdh/laravel-dompdf
```

---

## 🌐 10. Jalankan Server Laravel

```bash
php artisan serve
```

Akses aplikasi melalui:
👉 [http://localhost:8000](http://localhost:8000)

---

## 🔐 Login Admin

Silakan login menggunakan akun berikut:

```
Username : admin
Password : admin123
```

> 🛡️ Disarankan untuk **mengubah email dan password admin** setelah login pertama.

---

## 🙏 Salam Hangat,

**Ridho**
