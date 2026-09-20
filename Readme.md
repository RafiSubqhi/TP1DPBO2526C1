# JANJI
Saya Rafi Subqhi Nuraziz dengan NIM 2408678 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Fitur Wajib:
- Tambah Data: Menambah objek baru.
- Tampilkan Data: Menampilkan semua objek yang tersimpan.
- Update Data: Mengubah data objek berdasarkan identifier unik (seperti ID).
- Hapus Data: Menghapus objek berdasarkan identifier unik (ID).
- Cari Data: Mencari satu objek spesifik.

# Penjelasan Desain Kelas
Program ini menggunakan satu kelas utama yaitu Film dengan menerapkan konsep Encapsulation.
- Atribut (Private): id_film, judul, genre, sutradara, dan poster (path file). Aksesnya ditutup untuk menjaga keamanan data.
- Method (Public): Menggunakan Constructor untuk inisialisasi awal, serta Getter dan Setter untuk mengambil atau mengubah data
  atribut dari luar kelas.

# Alur Program (Flow Kode)
Program mengelola sekumpulan objek Film (Array of Objects) untuk fitur CRUD (Create, Read, Update, Delete) dan Search.

- Versi CLI (C++, Java, Python):
  Data disimpan secara dinamis menggunakan struktur data List/Vector/ArrayList. Program berjalan dalam sistem looping interaktif berbasis teks. Pencarian, pembaruan, dan penghapusan data dilakukan dengan pencocokan id_film di dalam array.

- Versi Web (PHP):
  Karena PHP bersifat stateless, Array of Objects disimpan di dalam $_SESSION agar data tidak hilang saat halaman dimuat ulang. Input data ditangkap melalui form HTML ($_POST), sedangkan fitur hapus memparsing ID melalui URL ($_GET). Data ditampilkan menggunakan perulangan foreach ke dalam tabel HTML.

# Dokumentasi Program
Berikut adalah bukti bahwa program berhasil dijalankan pada keempat bahasa pemrograman beserta fitur-fitur wajibnya (Tambah, Tampil, Update, Hapus, Cari):

  # Dokumentasi Program
Berikut adalah bukti bahwa program berhasil dijalankan pada keempat bahasa pemrograman beserta fitur-fitur wajibnya (Tambah, Tampil, Update, Hapus, Cari):

  ## Output Program C++
  ### Tambah Data
  ![Tambah Data](Dokumentasi/CPP/tambah%20data.png)
  ### Tampilkan Data
  ![Tampil Data](Dokumentasi/CPP/tampilkan%20data.png)
  ### Update data
  ![Update Data](Dokumentasi/CPP/update%20data.png)
  ### Hasil update
  ![Hasil Update](Dokumentasi/CPP/hasil%20update.png)
  ### Hapus data
  ![Hapus Data](Dokumentasi/CPP/hapus%20data.png)
  ### Hasil hapus
  ![Hasil Hapus](Dokumentasi/CPP/hasil%20hapus.png)
  ### Cari data
  ![Cari Data](Dokumentasi/CPP/cari%20data.png)

  ## Output Program Python
  ### Tambah Data
  ![Tambah Data](Dokumentasi/Python/tambah%20data.png)
  ### Tampilkan Data
  ![Tampil Data](Dokumentasi/Python/tampilkan%20data.png)
  ### Update data
  ![Update Data](Dokumentasi/Python/update%20data.png)
  ### Hasil update
  ![Hasil Update](Dokumentasi/Python/hasil%20update.png)
  ### Hapus data
  ![Hapus Data](Dokumentasi/Python/hapus%20data.png)
  ### Hasil hapus
  ![Hasil Hapus](Dokumentasi/Python/hasil%20hapus.png)
  ### Cari data
  ![Cari Data](Dokumentasi/Python/cari%20data.png)

  ## Output Program Java
  ### Tambah Data
  ![Tambah Data](Dokumentasi/Java/tambah%20data.png)
  ### Tampilkan Data
  ![Tampil Data](Dokumentasi/Java/tampilkan%20data.png)
  ### Update data
  ![Update Data](Dokumentasi/Java/update%20data.png)
  ### Hasil update
  ![Hasil Update](Dokumentasi/Java/hasil%20update.png)
  ### Hapus data
  ![Hapus Data](Dokumentasi/Java/hapus%20data.png)
  ### Hasil hapus
  ![Hasil Hapus](Dokumentasi/Java/hasil%20hapus.png)
  ### Cari data
  ![Cari Data](Dokumentasi/Java/cari%20data.png)

  ## Output Program PHP
  ### Tambah data
  ![Tambah Data](Dokumentasi/PHP/tambah%20data.png)
  ### Hasil tambah
  ![Hasil Tambah](Dokumentasi/PHP/hasil%20tambah.png)
  ### Tampilkan Data
  ![Tampil Data](Dokumentasi/PHP/tampilkan%20data.png)
  ### Update data
  ![Update Data](Dokumentasi/PHP/update%20data.png) 
  ### Hasil update
  ![Hasil Update](Dokumentasi/PHP/hasil%20update.png)
  ### Hapus data
  ![Hapus Data](Dokumentasi/PHP/hapus%20data.png)
  ### Hasil hapus
  ![Hasil Hapus](Dokumentasi/PHP/hasil%20hapus.png)
  ### Cari data
  ![Cari Data](Dokumentasi/PHP/cari%20data.png)