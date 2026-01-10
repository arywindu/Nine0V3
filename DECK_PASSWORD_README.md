# Deck Password Feature - Installation & Usage Guide

Fitur ini menambahkan sistem password untuk mengamankan akses ke halaman deck presentation.

## 📋 Fitur

1. **Admin Panel** - Manage password & link deck
2. **Password Protection** - User harus memasukkan password yang benar
3. **Custom Modals** - Modal sukses (fullscreen iframe) & error dengan styling brand
4. **Password Expiration** - Password akan expired sesuai setting
5. **Responsive** - Bekerja di desktop & mobile

## 🚀 Instalasi

### 1. Database Setup

Jalankan SQL script untuk membuat tabel `deck_settings`:

```bash
# Akses phpMyAdmin di http://localhost:8081
# Atau gunakan command line:
docker exec -i <mysql_container_name> mysql -u root -p nine0_portfolio < deck_password_update.sql
```

File SQL: `deck_password_update.sql`

### 2. Verifikasi File

Pastikan file-file berikut sudah ada:

**Controllers:**
- `application/controllers/Home.php` (updated dengan `verify_deck_password` method)
- `application/controllers/Admin.php` (updated dengan `deck_password` method)

**Views:**
- `application/views/deck.php` (updated dengan form & modals)
- `application/views/admin/deck_password.php` (NEW)

**Routes:**
- `application/config/routes.php` (updated dengan route deck & admin)

## 🎯 Cara Menggunakan

### A. Setup di Admin Panel

1. Login ke admin panel: `http://localhost:8080/admin`
2. Klik menu **"Deck Password"** di sidebar kiri
3. Form setting:
   - **Password**: Masukkan password baru (akan di-hash)
   - **Deck URL**: Paste embed URL dari Google Slides/Canva/etc
     - Google Slides: File → Share → Publish to web → Embed
     - Canva: Share → Present → Copy embed URL
   - **Expiration**: Pilih berapa hari password berlaku (default 7 hari)
4. Klik **"Update Settings"**

### B. Akses Halaman Deck (User)

1. Buka: `http://localhost:8080/deck`
2. Masukkan password yang sudah di-set di admin
3. Klik tombol arrow (→) atau tekan Enter
4. **Jika Benar**: Modal fullscreen muncul dengan iframe presentation
5. **Jika Salah**: Modal error muncul dengan pesan kesalahan

## 🔐 Default Credentials

**Admin Login:**
- Username: `admin`
- Password: `password`

**Default Deck Password** (setelah run SQL):
- Password: `password`
- Expires: 7 hari dari install

## 🧪 Testing Checklist

### Admin Panel
- [ ] Login berhasil
- [ ] Menu "Deck Password" muncul di sidebar
- [ ] Form dapat diisi dan submit
- [ ] Success message muncul setelah update
- [ ] Current settings ditampilkan dengan benar
- [ ] Countdown expiry days bekerja

### Deck Page
- [ ] Form password terlihat
- [ ] Submit dengan password salah → Error modal muncul
- [ ] Submit dengan password benar → Success modal + iframe muncul
- [ ] Iframe menampilkan presentasi dengan benar
- [ ] Close button modal berfungsi
- [ ] Password expired → Error message sesuai

## 📁 Struktur Database

```sql
deck_settings:
- id (INT, PK, AI)
- password (VARCHAR 255) - hashed dengan password_hash()
- deck_url (TEXT) - embed URL
- expires_at (DATETIME) - tanggal expired
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

## 🎨 Styling & Branding

Modal menggunakan warna brand:
- Background: `#FFE600` (Yellow)
- Accent: `#F15A29` (Orange)
- Text: `#333333` (Black)
- Font: Square 721 Extended, Inter

## 🔄 API Endpoints

### Verify Password (AJAX)
- **URL**: `/verify-deck-password`
- **Method**: POST
- **Params**: `password=xxx`
- **Response**: 
```json
{
  "success": true,
  "deck_url": "https://...",
  "expires_at": "January 17, 2026"
}
```

## 🐛 Troubleshooting

**Problem**: Modal tidak muncul
- **Solution**: Pastikan Bootstrap JS loaded

**Problem**: AJAX error 404
- **Solution**: Check routes.php, pastikan route `verify-deck-password` ada

**Problem**: Password selalu salah
- **Solution**: Pastikan password di-hash dengan `password_hash()`, bukan plain text

**Problem**: iframe kosong
- **Solution**: Pastikan deck URL adalah embed URL, bukan share URL

## 📞 Support

Jika ada masalah:
1. Check console browser (F12) untuk errors
2. Check CodeIgniter logs di `application/logs/`
3. Pastikan database connection OK

## 🎉 Done!

Fitur deck password sudah siap digunakan! 🚀
