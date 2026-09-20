import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        ArrayList<Film> daftar_film = new ArrayList<>();
        Scanner scanner = new Scanner(System.in);
        String pilih;

        while (true) {
            System.out.println("\n=== MENU BIOSKOP ===");
            System.out.println("1. Tambah Film\n2. Tampilkan Film\n3. Update Film\n4. Hapus Film\n5. Cari Film\n0. Keluar");
            System.out.print("Pilih menu: ");
            pilih = scanner.nextLine().trim();

            if (pilih.equals("1")) {
                System.out.println("\n--- TAMBAH FILM ---");
                String id_f;

                // 1. Kunci input ID agar tidak boleh kosong
                while (true) {
                    System.out.print("ID: ");
                    id_f = scanner.nextLine().trim();
                    if (id_f.isEmpty()) System.out.println("ERROR: ID tidak boleh kosong!");
                    else break;
                }

                // 2. Cek apakah ID sudah ada
                boolean id_sudah_ada = false;
                for (Film f : daftar_film) {
                    if (f.getId().equals(id_f)) {
                        id_sudah_ada = true;
                        break;
                    }
                }

                if (id_sudah_ada) {
                    System.out.println("ERROR: ID sudah digunakan! Silakan masukkan ID yang unik.");
                } else {
                    String jud, gen, sut;

                    // 3. Kunci input lainnya agar tidak boleh kosong
                    while (true) {
                        System.out.print("Judul: ");
                        jud = scanner.nextLine().trim();
                        if (jud.isEmpty()) System.out.println("ERROR: Judul tidak boleh kosong!");
                        else break;
                    }
                    
                    while (true) {
                        System.out.print("Genre: ");
                        gen = scanner.nextLine().trim();
                        if (gen.isEmpty()) System.out.println("ERROR: Genre tidak boleh kosong!");
                        else break;
                    }
                    
                    while (true) {
                        System.out.print("Sutradara: ");
                        sut = scanner.nextLine().trim();
                        if (sut.isEmpty()) System.out.println("ERROR: Sutradara tidak boleh kosong!");
                        else break;
                    }

                    daftar_film.add(new Film(id_f, jud, gen, sut));
                    System.out.println("Berhasil ditambah!");
                }
            }
            else if (pilih.equals("2")) {
                if (daftar_film.isEmpty()) {
                    System.out.println("\nData film masih kosong.");
                } else {
                    System.out.println("\n--- DAFTAR FILM ---");
                    for (Film f : daftar_film) {
                        System.out.println("ID        : " + f.getId());
                        System.out.println("Judul     : " + f.getJudul());
                        System.out.println("Genre     : " + f.getGenre());
                        System.out.println("Sutradara : " + f.getSutradara() + "\n");
                    }
                }
            }
            else if (pilih.equals("3")) {
                System.out.println("\n--- UPDATE FILM ---");
                System.out.print("Masukkan ID film yang akan diupdate: ");
                String id_cari = scanner.nextLine().trim();
                
                boolean ketemu = false;
                for (Film f : daftar_film) {
                    if (f.getId().equals(id_cari)) {
                        System.out.println("(Tekan Enter saja jika tidak ingin mengubah data)");

                        // --- LOGIKA UPDATE ID ---
                        while (true) {
                            System.out.print("ID Baru (" + f.getId() + "): ");
                            String id_baru = scanner.nextLine().trim();
                            
                            if (id_baru.isEmpty()) {
                                break; // User menekan Enter, lewati update ID
                            }
                            
                            if (!id_baru.equals(f.getId())) {
                                // Cek apakah ID baru ini dipakai oleh film LAIN
                                boolean bentrok = false;
                                for (Film film_lain : daftar_film) {
                                    if (film_lain.getId().equals(id_baru)) {
                                        bentrok = true;
                                        break;
                                    }
                                }
                                
                                if (bentrok) {
                                    System.out.println("ERROR: ID '" + id_baru + "' sudah dipakai! Silakan gunakan ID lain.");
                                } else {
                                    f.setId(id_baru); // Update ke ID baru
                                    break;
                                }
                            } else {
                                break; // ID baru sama dengan ID lama, aman
                            }
                        }
                        // -------------------------

                        // Karena input bisa sengaja dikosongkan (di-skip), kita cek dengan isEmpty()
                        System.out.print("Judul Baru (" + f.getJudul() + "): ");
                        String jud_baru = scanner.nextLine().trim();
                        if (!jud_baru.isEmpty()) f.setJudul(jud_baru);

                        System.out.print("Genre Baru (" + f.getGenre() + "): ");
                        String gen_baru = scanner.nextLine().trim();
                        if (!gen_baru.isEmpty()) f.setGenre(gen_baru);

                        System.out.print("Sutradara Baru (" + f.getSutradara() + "): ");
                        String sut_baru = scanner.nextLine().trim();
                        if (!sut_baru.isEmpty()) f.setSutradara(sut_baru);

                        System.out.println("Update berhasil!");
                        ketemu = true;
                        break;
                    }
                }
                if (!ketemu) System.out.println("ID tidak ditemukan.");
            }
            else if (pilih.equals("4")) {
                System.out.println("\n--- HAPUS FILM ---");
                System.out.print("Masukkan ID film yang akan dihapus: ");
                String id_cari = scanner.nextLine().trim();
                
                boolean ketemu = false;
                for (int i = 0; i < daftar_film.size(); i++) {
                    if (daftar_film.get(i).getId().equals(id_cari)) {
                        daftar_film.remove(i);
                        System.out.println("Berhasil dihapus!");
                        ketemu = true;
                        break;
                    }
                }
                if (!ketemu) System.out.println("ID tidak ditemukan.");
            }
            else if (pilih.equals("5")) {
                System.out.println("\n--- CARI FILM ---");
                System.out.print("Masukkan judul film: ");
                String cari = scanner.nextLine().trim().toLowerCase();
                
                boolean ketemu = false;
                for (Film f : daftar_film) {
                    if (f.getJudul().toLowerCase().contains(cari)) {
                        System.out.println("ID        : " + f.getId());
                        System.out.println("Judul     : " + f.getJudul());
                        System.out.println("Genre     : " + f.getGenre());
                        System.out.println("Sutradara : " + f.getSutradara());
                        ketemu = true;
                    }
                }
                if (!ketemu) System.out.println("Film tidak ditemukan.");
            }
            else if (pilih.equals("0")) {
                System.out.println("Keluar dari program...");
                break;
            }
            else {
                System.out.println("Pilihan tidak valid!");
            }
        }
        scanner.close();
    }
}