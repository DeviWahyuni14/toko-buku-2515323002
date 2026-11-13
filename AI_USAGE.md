**AI yang digunakan:** ChatGPT (OpenAI)

# 1. Pembuatan CRUD Penulis
- Meminta panduan pembuatan Model Author dan migration tabel `authors`.
- Meminta bantuan menyusun `AuthorController` untuk fitur tambah, tampil, ubah, dan hapus penulis.
- Membuat halaman Blade untuk daftar, tambah, dan ubah penulis.
- Menambahkan menu Penulis pada navbar aplikasi.
- Menguji proses tambah, ubah, dan hapus data penulis.

# 2. Validasi dan Relasi Penulis dengan Buku
- Meminta penjelasan validasi nama penulis agar wajib diisi, maksimal 100 karakter, dan tidak duplikat.
- Meminta panduan menambahkan kolom `author_id` pada tabel `books` tanpa menghapus data lama.
- Membuat relasi `belongsTo` pada Model Book dan `hasMany` pada Model Author.
- Menambahkan dropdown Penulis Terdaftar pada formulir tambah dan ubah buku.
- Mempertahankan kolom `author_name` agar data buku lama tetap dapat digunakan.
- Menambahkan validasi `author_id` agar hanya menerima penulis yang terdaftar.

# 3. Pengujian dan Perbaikan Error
- Meminta bantuan mengatasi error `Undefined variable` pada halaman Blade.
- Memperbaiki variabel dan pengiriman data dari Controller ke View.
- Memperbaiki method `update()` pada BookController agar perubahan `author_id` dapat disimpan.
- Menggunakan Laravel Tinker untuk memeriksa nilai `author_id` pada database.
- Menguji larangan penghapusan penulis yang masih digunakan oleh buku.
- Memperbaiki tampilan detail buku agar dapat menampilkan Penulis Terdaftar.
- Meminta bantuan mengatasi error relasi `BelongsTo` pada Model Book.
- Meminta panduan memperbaiki error `Trait App\Models\HasFactory not found` dengan menambahkan import trait yang benar.

# 4. Hasil Penggunaan AI
- Fitur CRUD Penulis telah dibuat dan diuji.
- Dropdown Penulis Terdaftar telah ditambahkan ke formulir buku.
- Penyimpanan relasi Penulis–Buku berhasil diuji.
- Validasi penghapusan penulis yang masih terhubung dengan buku berhasil diuji.
- Perbaikan error pada Model Book telah diberikan dan perlu diuji kembali setelah diterapkan.

# 5. Kesimpulan
## Kesimpulan

Penggunaan ChatGPT dalam pengerjaan UTS Laravel BookStore membantu proses pengembangan fitur CRUD Penulis, validasi data, pembuatan relasi antara Penulis dan Buku, serta perbaikan berbagai error pada aplikasi.

Melalui bantuan AI, saya dapat lebih memahami penggunaan Model, Controller, View, Migration, dan relasi database pada Laravel. Fitur CRUD Penulis, penyimpanan `author_id`, dan proteksi penghapusan penulis yang masih digunakan oleh buku telah berhasil diuji.

ChatGPT digunakan sebagai alat bantu pembelajaran dan debugging, sedangkan proses implementasi, pengujian, dan pemeriksaan hasil dilakukan secara langsung oleh saya. Dengan demikian, penggunaan AI tidak hanya membantu penyelesaian tugas, tetapi juga meningkatkan pemahaman saya terhadap pengembangan aplikasi berbasis Laravel.