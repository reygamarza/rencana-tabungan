
![Logo](https://www.bara.co.id/assets/images/icon/LOGO%20BARA%20TEKNOVASI%201.webp)



# Aplikasi Berbasis Web Rencana Tabungan

Aplikasi ini dikembangkan guna membantu pengguna dalam merencanakan dan mengelola tabungan mereka secara lebih terstruktur.



## 🔗 Links
[Lampiran Pendukung (Drive)](https://drive.google.com/drive/folders/1UQLOeXDae8GCgU8x9a0qpwM0ipwJ97YT?usp=drive_link)


## 🛠️ Langkah-Langkah Clone Project Laravel

### 1. Clone Repository

Pertama, clone repository dari server Git menggunakan perintah berikut:

```bash
git clone https://github.com/reygamarza/rencana-tabungan.git
```

### 2. Masuk ke Direktori Project

Setelah clone berhasil, masuk ke dalam direktori project:

```bash
cd rencana-tabungan
```

### 3. Instal Dependency Composer

Untuk menginstal dependensi PHP yang diperlukan oleh Laravel, jalankan perintah berikut:

```bash
composer install
```

### 4. Instal Dependency Node.js

Instal semua dependensi JavaScript menggunakan npm:

```bash
npm install
```

### 5. Salin File `.env.example` Menjadi `.env`

Laravel menggunakan file `.env` untuk mengelola konfigurasi. Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

### 6. Generate App Key

Laravel membutuhkan "app key" untuk enkripsi. Generate key ini menggunakan perintah berikut:

```bash
php artisan key:generate
```

### 7. Konfigurasi Database

Buka file `.env` dan edit pengaturan database Anda sesuai dengan konfigurasi lokal:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Migrasi Database

Setelah mengatur koneksi database, jalankan migrasi untuk membuat tabel-tabel yang dibutuhkan:

```bash
php artisan migrate
```

### 9. Jalankan Server Local Development

Akhirnya, jalankan Laravel development server:

```bash
php artisan serve
```

Server akan berjalan di \`http://localhost:8000\`.

### 10. Jalankan Build Frontend (Opsional)

Jika project menggunakan asset frontend seperti CSS dan JS, jalankan perintah berikut untuk melakukan build:

```bash
npm run dev
```

Untuk versi production:

```bash
npm run build
```

---

Selamat Menikmati 😁
    