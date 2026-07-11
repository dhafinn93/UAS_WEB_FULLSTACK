🏠 Kos Impianmu

Aplikasi web pencarian dan manajemen kos berbasis Laravel yang memungkinkan pengguna mau Mahasiswa ataupun bukan untuk menemukan kos impian mereka, melihat detail fasilitas, memberikan ulasan, serta dilengkapi panel admin untuk pengelolaan data kos.

1. Bahasa Pemrograman yang Digunakan
   
    | Bahasa | Kegunaan |  
    | :--- | :--- | 
    | PHP 8.3  | Bahasa utama back-end server-side | 
    | HTML5  | Struktur halaman web via Blade template engine | 
    | CSS3  | Styling dan tampilan antarmuka pengguna |
    | JavaScript | Interaktivitas front-end (toggle password, star rating interaktif, character counter) |
    | MySQL | Query dan manajemen database melalui Eloquent ORM |
  
2. Framework, Library, dan API yang Digunakan
   
     Framework Utama  
    | Framework | Versi | Kegunaan |  
    | :--- | :--- | :--- | 
    | Laravel | ^12.0 | Framework PHP utama — routing, MVC, ORM, middleware, session, validasi |   
   
   Library Front-end (via CDN) yang digunakan :
    | Library | Versi | Kegunaan |  
    | :--- | :--- | :--- | 
    | Bootstrap | 5.3.5 | Komponen UI responsif — grid, card, table, form, navbar, badge, progress bar |  
    | Bootstrap Icons | 1.11.3 | Ikon antarmuka pada halaman login dan register (toggle mata password) |
    | Font Awesome | 6.2.7 | Ikon antarmuka pada halaman utama, detail kos, dan panel user/admin |
   
   Library Back-end (via Composer) yang digunakan:
    | Library | Versi | Kegunaan |  
    | :--- | :--- | :--- | 
    | laravel/sanctum | ^4.0 | Autentikasi berbasis token (disiapkan untuk kebutuhan API) |  
    | laravel/tinker | ^2.10.1 | REPL interaktif untuk debugging di terminal |
    | fakerphp/faker | ^1.23 | Generate data dummy untuk keperluan testing dan seeder |

   Fitur Bawaan Laravel yang Dimanfaatkan
   
    - Eloquent ORM — relasi antar model (hasMany, belongsTo) dan query database
    - Laravel Storage — upload dan manajemen foto kos ke disk public dengan auto-delete
    - Middleware — proteksi route berdasarkan role (admin / user)
    - Blade Templating — layout master (layouts/app), @section, @yield, @push('js')
    - Migration — manajemen skema database secara versional dan terstruktur
    - Session & Flash Message — notifikasi sukses/error antar request
    - Route Resource — pendaftaran route CRUD otomatis untuk kos dan review

   API yang digunakan yaitu:

   API Publik
    | Method | Endpoint | Fungsi |  
    | :--- | :--- | :--- | 
    | GET | / | Menampilkan beranda dengan daftar semua kos |   
    | GET | /detail_kos/{id} | Menampilkan halaman detail kos beserta ulasan |   
    | GET | /login | Menampilkan form login |   
    | POST | /login | Memproses login pengguna |   
    | GET | /register | Menampilkan form registrasi |   
    | POST | /register | Memproses pendaftaran akun baru |   
    | POST | /logout | Memproses logout dan mengakhiri sesi |

   Endpoint Admin (memerlukan autentikasi + role admin)
    | Method | Endpoint | Fungsi |  
    | :--- | :--- | :--- | 
    | GET | /admin/dashboard | Menampilkan halaman dashboard admin |   
    | GET | /admin/kos | Menampilkan daftar semua kos |   
    | GET | /admin/kos/create | Menampilkan form tambah kos baru |   
    | POST | /admin/kos | Menyimpan data kos baru beserta foto |   
    | GET | /admin/kos/{id}/edit | Menampilkan form edit kos |   
    | PUT | /admin/kos/{id} | Memperbarui data kos (foto lama otomatis dihapus) |   
    | DELETE | /admin/kos/{id} | Menghapus kos beserta foto dari storage |

    Endpoint User (memerlukan autentikasi + role user)
    | Method | Endpoint | Fungsi |  
    | :--- | :--- | :--- | 
    | GET | /user/dashboard | Menampilkan halaman dashboard user |   
    | GET | /user/review | Menampilkan daftar review milik user |   
    | GET | /user/review/create/{id} | Menampilkan form buat review untuk kos tertentu |   
    | POST | /user/review | Menyimpan review baru |   
    | GET | /user/review/{id}/edit| Menampilkan form edit review |   
    | PUT | /user/review/{id} | Memperbarui review milik sendiri |   
    | DELETE | /user/review/{id} | Menghapus review milik sendiri |
   
4. Fungsi dan Fitur Proyek yang Dibangun

    🔐 Autentikasi

    - Register — Pendaftaran akun baru dengan input nama, email, dan password
    - Login — Masuk ke sistem menggunakan email dan password
    - Logout — Mengakhiri sesi pengguna yang sedang aktif
    - Toggle Mata Password — Tombol tampilkan/sembunyikan password menggunakan Bootstrap Icons, tersedia di form login (1 field) dan register (2 field: password & konfirmasi)

    🌐 Halaman Publik

    - Beranda — Menampilkan seluruh daftar kos dalam bentuk card grid dengan foto, alamat, dan harga; dilengkapi fitur pencarian berdasarkan nama kos
    - Detail Kos — Halaman lengkap berisi foto kos, nama, alamat, fasilitas, harga, tombol "Beri Review" (khusus user login), statistik rata-rata rating, distribusi bintang 1–5 dalam progress bar, dan daftar semua ulasan pengguna

    🛠️ Panel Admin

    - Dashboard Admin — Halaman utama admin dengan navigasi pengelolaan
    - Kelola Kos (CRUD) — Admin dapat menambah kos baru beserta upload foto, melihat daftar semua kos, mengedit data kos (dengan penggantian foto otomatis hapus file lama), dan menghapus kos (foto ikut terhapus dari storage)
    - Seluruh route admin dilindungi middleware auth + admin
  
    ⭐ Panel User

    - Dashboard User — Menampilkan daftar kos yang dapat dikunjungi atau direview
    - Daftar Review Saya — Tabel semua review milik user yang sedang login, lengkap dengan nama kos, rating bintang, cuplikan komentar, dan tanggal
    - Buat Review — Form tambah review dengan info kos di bagian atas, pilih rating 1–5 bintang secara interaktif (hover + klik + label deskripsi), dan textarea komentar dengan counter karakter (maks 1000)
    - Edit Review — Form edit review yang sudah ada, dengan nilai rating dan komentar ter-prefill dari data sebelumnya
    - Hapus Review — Menghapus review dengan konfirmasi dialog sebelum eksekusi
    - User hanya dapat mengakses review miliknya sendiri (proteksi HTTP 403 jika mencoba akses review orang lain)
    - Seluruh route user dilindungi middleware auth + user
  
    🗄️ Database
   
    Tabel yang dikelola dalam proyek ini:
    | Tabel | Kolom Utama |  
    | :--- | :--- | 
    | users  | id, name, email, password, role | 
    | kos | id, nama_kos, alamat, fasilitas, harga, foto_kos |
    | reviews | id, kos_id, user_id, rating, komentar |

   Tabel reviews menggunakan foreign key onDelete('cascade') — jika kos dihapus, semua reviewnya ikut terhapus otomatis.

5. Kelebihan Proyek yang Dibangun

      - Sistem Role Terpisah dan Aman — Admin dan user memiliki akses, route, dan tampilan yang sepenuhnya terpisah, dikelola melalui middleware sehingga tidak bisa saling mengakses.
      - Proteksi Data di Level Controller — Setiap operasi pada review (lihat, edit, hapus) dilindungi pengecekan user_id di controller, bukan hanya di route, sehingga lebih aman dari manipulasi URL.
      - Auto-Delete File Storage — Saat foto kos diganti atau kos dihapus, file lama di storage/app/public/kos/ otomatis dihapus, mencegah penumpukan file yang tidak terpakai.
      - UI Responsif — Menggunakan Bootstrap 5 sehingga tampilan menyesuaikan layar desktop, tablet, maupun mobile secara otomatis.
      - Star Rating Interaktif — Pemilihan rating bintang dilengkapi efek hover, klik, dan label deskripsi teks (Sangat Buruk–Sangat Baik) sehingga pengalaman pengguna lebih intuitif.
      - Toggle Mata Password — Pengguna dapat melihat atau menyembunyikan password saat mengetik, mengurangi kesalahan input tanpa mengorbankan keamanan.
      - Statistik Rating Visual — Halaman detail kos menampilkan rata-rata rating numerik, bintang, jumlah ulasan, dan distribusi per bintang dalam progress bar — memudahkan calon penyewa membaca kualitas kos.
      - Struktur MVC Terorganisir — Controller dipisah berdasarkan namespace (Admin\, User\, Web\) sehingga kode mudah dibaca, dikembangkan, dan dipelihara.
      - Flash Message — Setiap aksi CRUD menampilkan notifikasi sukses atau error yang otomatis hilang, memberikan feedback yang jelas kepada pengguna.
      - Cascade Delete Otomatis — Relasi database dengan onDelete('cascade') memastikan integritas data terjaga tanpa perlu penghapusan manual secara berlapis.

6. Kekurangan Proyek yang Dibangun (Bug / Warning)

   - Tidak Ada Validasi Duplikat Review — Seorang user dapat memberikan lebih dari satu review untuk kos yang sama tanpa pembatasan. Idealnya ditambahkan validasi unique(['user_id', 'kos_id']) di tabel reviews dan pengecekan di controller sebelum menyimpan.
   - Tidak Ada Pagination — Daftar kos di beranda dan daftar review di panel user ditampilkan sekaligus tanpa pagination. Jika data sudah banyak, halaman akan sangat panjang dan performa query menurun.
   - Tidak Ada Verifikasi Email — Proses register tidak menyertakan konfirmasi ke email, sehingga siapapun dapat mendaftar menggunakan email palsu atau email milik orang lain.
   - Validasi Kekuatan Password Lemah — Saat register, password hanya diwajibkan cocok dengan kolom konfirmasi tanpa syarat panjang minimum, kombinasi huruf/angka, atau
   - karakter khusus. Password sangat pendek seperti 1 dapat diterima sistem.
   - Tidak Ada Validasi File Upload — Form upload foto kos di panel admin tidak memvalidasi tipe file (seharusnya hanya menerima jpg, png, webp) maupun ukuran maksimum. Ini berpotensi menerima file berbahaya atau terlalu besar.
   - Tidak Ada Fitur Pencarian/Filter Lanjutan — Pencarian di beranda hanya berdasarkan nama kos. Pengguna tidak dapat memfilter berdasarkan lokasi, rentang harga, fasilitas, atau rating minimum.
   - Middleware user Mengembalikan Response JSON — UserMiddleware mengembalikan response()->json() saat akses ditolak, yang tidak sesuai untuk aplikasi web berbasis Blade.
   - Seharusnya melakukan redirect ke halaman login atau menampilkan halaman error 403 yang proper.
   - Tidak Ada Fitur Lupa Password — Tidak tersedia mekanisme reset password apabila pengguna lupa, sehingga akun yang terkunci tidak dapat dipulihkan secara mandiri.
  
Cara Instalasi

    # Clone atau extract project
    
    git clone <url-repo>
    cd UAS_WEB_FULLSTACK

    # Install dependensi PHP
    
    composer install

    # Salin file konfigurasi environment
    
    cp .env.example .env

    # Generate application key
    
    php artisan key:generate

    # Atur koneksi database di file .env
    
    DB_CONNECTION=mysql
    
    DB_DATABASE=nama_database
    
    DB_USERNAME=root
    
    DB_PASSWORD=

    # Jalankan migrasi database
   
    php artisan migrate
    
    # Buat symlink storage untuk akses foto publik
   
    php artisan storage:link
    
    # Jalankan server development
   
    php artisan serve
  
   
