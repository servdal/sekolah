<p align="center"><a href="https://duidev.com" target="_blank"><img src="https://github.com/servdal/sdtq/blob/master/public/header.png" width="400"></a></p>

<p align="center">
<a href="https://amil.sdimohammadhatta.sch.id"><img src="https://simbian.duidev.com/logo/1602884372logo.png" width="35" alt="SDI Mohammad Hatta Malang"></a>
<a href="https://gmm.duidev.com"><img src="https://gmm.duidev.com/logo/1603375609logo.png" width="35" alt="Yayasan Gema Mitra Muslim"></a>
<a href="https://sdtqdu.sch.id/"><img src="https://sdtqdu.sch.id/logo.png" width="35" alt="SDTQ Daarul Ukhuwwah"></a>
<a href="https://sisfo.mutiarahati.sch.id/"><img src="https://sisfo.mutiarahati.sch.id/logo/3-1728523474logo.png" width="35" alt="Mutiara Hati"></a>

</p>

## Sistem Manajemen Sekolah Terpadu

Aplikasi Sistem Manajemen Sekolah Terpadu adalah sebuah aplikasi yang dikembangkan untuk membantu manajemen sekolah dalam mengelola berbagai aspek kegiatan sehari-hari di sekolah.

## Deskripsi

Aplikasi ini dirancang untuk memudahkan administrasi sekolah dalam mengelola data siswa, data guru, jadwal pelajaran, absensi, catatan rapat, dan masih banyak lagi. Dengan antarmuka yang intuitif dan fitur-fitur yang lengkap, aplikasi ini dapat membantu meningkatkan efisiensi dan kualitas layanan pendidikan di sekolah.


## Fitur Utama

- Manajemen Data Siswa: Tambah, edit, dan hapus data siswa dengan mudah.
- Manajemen Data Guru: Kelola informasi guru termasuk data pribadi, pengalaman kerja, dan lainnya.
- Jadwal Pelajaran: Buat jadwal pelajaran yang dapat diakses oleh semua pihak terkait.
- Absensi Siswa: Rekam absensi siswa secara elektronik dan pantau kehadiran mereka dengan mudah.
- Catatan Alquran: Simpan catatan murojaah / tahsin / Ziyadah / Tilawah.
- Database Keuangan : Tabungan Siswa, Neraca Pemasukan dan Pengeluaran Sekolah, Laporan SPP / DPP / Insidental

## Instalasi Mobile Apps

1. Unduh aplikasi dari [Google Play Store](https://play.google.com/store/apps/details?id=com.duidev.simaster).
2. Instal aplikasi di perangkat Android Anda.
3. Buka aplikasi dan ikuti panduan konfigurasi yang disediakan.

**Catatan**: Aplikasi ini menggunakan WebView untuk mengakses aplikasi berbasis web yang terletak di [simbian.duidev.com](https://simbian.duidev.com/), yang dikembangkan oleh [Duidev](https://duidev.com/).

### Instalasi dari GitHub

1. Unduh aplikasi dari [halaman GitHub repository](https://github.com/servdal/sekolah).
2. Ekstrak file ZIP yang telah diunduh ke dalam direktori web server Anda.
3. Buka terminal atau command prompt dan arahkan ke direktori aplikasi.
4. Jalankan perintah `php composer.phar update` untuk menginstal semua dependensi PHP.
5. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
6. Pastikan untuk Email sudah di isikan username dan password dan server SMTP anda (karena default pendaftaran menggunakan email untuk aktivasi)
7. Jalankan perintah `php artisan key:generate` untuk menghasilkan kunci aplikasi yang unik.
8. import file sql yg ada di folder database/scheme/.
9. Jalankan perintah `php artisan config:cache`.
10. Akses aplikasi melalui browser Anda (Username dan Password Default : simaster@duidev.com | bismillah).

### Instalasi Local Webserver (XAMPP / Linux dengan Apache/Nginx)

Pastikan Anda telah menginstal XAMPP atau konfigurasi server web yang sesuai di lingkungan Linux Anda. Pastikan juga PHP minimal versi 8 dan MySQL telah terinstal.

1. Unduh aplikasi dari [halaman GitHub repository](https://github.com/servdal/sekolah).
2. Ekstrak file ZIP yang telah diunduh ke dalam direktori web server Anda.
3. Buka terminal dan arahkan ke direktori aplikasi.
4. Jalankan perintah `php composer.phar update` untuk menginstal semua dependensi PHP.
5. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
6. Pastikan untuk Email sudah di isikan username dan password dan server SMTP anda (karena default pendaftaran menggunakan email untuk aktivasi)
7. Jalankan perintah `php artisan key:generate` untuk menghasilkan kunci aplikasi yang unik.
8. import file sql yg ada di folder database/scheme/.
9. Jalankan perintah `php artisan config:cache`.
9. Buka web browser Anda dan arahkan ke alamat URL tempat aplikasi telah diinstal (Username dan Password Default : simaster@duidev.com | bismillah).

## Kontribusi

Kami terbuka terhadap kontribusi dari komunitas. Jika Anda menemukan masalah atau ingin berkontribusi dalam pengembangan aplikasi ini, silakan buka [laporan masalah](https://github.com/servdal/sekolah/issues) atau kirimkan pull request.

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).

## Donasi

Jika Anda ingin mendukung pengembangan aplikasi ini, Anda dapat berdonasi melalui transfer bank ke rekening berikut:
- BRI, Norek : 005101142079504
- Mandiri, Norek : 1440019278099
- BSI, Norek : 7167036915

An. Dwi Swandhana Rahmadi Putra

