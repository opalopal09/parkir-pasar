# Validasi Plat Nomor - Update Log

## ✅ Fitur yang Ditambahkan

### 1. **Validasi Format Plat Nomor**
- **Regex Pattern:** `/^[A-Z]{1,2}\s?\d{1,4}\s?[A-Z]{1,3}$/i`
- **Format yang Valid:**
  - `B 1234 ABC`
  - `D 567 EF`
  - `AB 9999 XYZ`
  - `B1234ABC` (tanpa spasi juga valid)

### 2. **Cek Duplikasi Plat Nomor**
- Sistem akan mengecek apakah plat nomor sudah terdaftar dengan status `masuk` (masih parkir)
- Jika sudah ada, akan muncul error: **"Plat nomor ini sudah terdaftar dan masih parkir."**
- Plat nomor yang sama boleh digunakan jika kendaraan sebelumnya sudah keluar (status `keluar`)

## 📝 Perubahan pada File

### `app/Http/Controllers/KendaraanController.php`

#### Method `store()` (Tambah Kendaraan)
- Ditambahkan validasi regex untuk format plat nomor
- Ditambahkan custom validation untuk cek duplikasi
- Ditambahkan custom error messages

#### Method `update()` (Edit Kendaraan)
- Ditambahkan validasi yang sama seperti `store()`
- Menggunakan `where('id', '!=', $id)` untuk mengecualikan data yang sedang diedit

## 🎯 Manfaat

1. **Keamanan Data:** Mencegah duplikasi plat nomor untuk kendaraan yang masih parkir
2. **Validasi Format:** Memastikan plat nomor sesuai format Indonesia
3. **User Experience:** Pesan error yang jelas dan informatif
4. **Fleksibilitas:** Plat nomor yang sama bisa digunakan lagi setelah kendaraan keluar

## 🧪 Testing

Coba test dengan skenario berikut:
1. ✅ Tambah kendaraan dengan plat `B 1234 ABC` → Berhasil
2. ❌ Tambah kendaraan lagi dengan plat `B 1234 ABC` (masih parkir) → Error duplikasi
3. ✅ Proses keluar kendaraan pertama
4. ✅ Tambah kendaraan baru dengan plat `B 1234 ABC` → Berhasil (karena yang lama sudah keluar)
5. ❌ Tambah kendaraan dengan plat `123ABC` → Error format tidak valid
