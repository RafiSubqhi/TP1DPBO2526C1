#include <iostream>
#include <string>
#include <vector>
#include <algorithm>
#include <cctype>
#include "Film.cpp"

using namespace std;

// Fungsi untuk mengubah string ke huruf kecil
string toLower(string str) {
    transform(str.begin(), str.end(), str.begin(), ::tolower);
    return str;
}

// Fungsi pembantu untuk memotong spasi kosong (seperti .strip() di Python)
string trim(const string& str) {
    size_t first = str.find_first_not_of(" \t\n\r");
    if (first == string::npos) return ""; // Jika isinya spasi semua
    size_t last = str.find_last_not_of(" \t\n\r");
    return str.substr(first, (last - first + 1));
}

int main() {
    vector<Film> daftar_film;
    string pilih;

    while (true) {
        cout << "\n=== MENU BIOSKOP ===" << endl;
        cout << "1. Tambah Film\n2. Tampilkan Film\n3. Update Film\n4. Hapus Film\n5. Cari Film\n0. Keluar" << endl;
        cout << "Pilih menu: ";
        getline(cin, pilih);
        pilih = trim(pilih);

        if (pilih == "1") {
            cout << "\n--- TAMBAH FILM ---" << endl;
            string id_f;
            
            // 1. Kunci input ID agar tidak boleh kosong
            while (true) {
                cout << "ID: ";
                getline(cin, id_f);
                id_f = trim(id_f);
                if (id_f.empty()) cout << "ERROR: ID tidak boleh kosong!" << endl;
                else break;
            }

            // 2. Cek apakah ID sudah ada
            bool id_sudah_ada = false;
            for (Film& f : daftar_film) {
                if (f.getId() == id_f) {
                    id_sudah_ada = true;
                    break;
                }
            }

            if (id_sudah_ada) {
                cout << "ERROR: ID sudah digunakan! Silakan masukkan ID yang unik." << endl;
            } else {
                string jud, gen, sut;
                
                // 3. Kunci input lainnya agar tidak boleh kosong
                while (true) {
                    cout << "Judul: ";
                    getline(cin, jud);
                    jud = trim(jud);
                    if (jud.empty()) cout << "ERROR: Judul tidak boleh kosong!" << endl;
                    else break;
                }
                
                while (true) {
                    cout << "Genre: ";
                    getline(cin, gen);
                    gen = trim(gen);
                    if (gen.empty()) cout << "ERROR: Genre tidak boleh kosong!" << endl;
                    else break;
                }
                
                while (true) {
                    cout << "Sutradara: ";
                    getline(cin, sut);
                    sut = trim(sut);
                    if (sut.empty()) cout << "ERROR: Sutradara tidak boleh kosong!" << endl;
                    else break;
                }
                
                daftar_film.push_back(Film(id_f, jud, gen, sut));
                cout << "Berhasil ditambah!" << endl;
            }
        }
        else if (pilih == "2") {
            if (daftar_film.empty()) {
                cout << "\nData film masih kosong." << endl;
            } else {
                cout << "\n--- DAFTAR FILM ---" << endl;
                for (Film& f : daftar_film) {
                    cout << "ID        : " << f.getId() << endl;
                    cout << "Judul     : " << f.getJudul() << endl;
                    cout << "Genre     : " << f.getGenre() << endl;
                    cout << "Sutradara : " << f.getSutradara() << "\n" << endl;
                }
            }
        }
        else if (pilih == "3") {
            cout << "\n--- UPDATE FILM ---" << endl;
            string id_cari;
            cout << "Masukkan ID film yang akan diupdate: ";
            getline(cin, id_cari);
            id_cari = trim(id_cari);
            
            bool ketemu = false;
            for (Film& f : daftar_film) {
                if (f.getId() == id_cari) {
                    cout << "(Tekan Enter saja jika tidak ingin mengubah data)" << endl;
                    
                    // --- LOGIKA UPDATE ID ---
                    while (true) {
                        string id_baru;
                        cout << "ID Baru (" << f.getId() << "): ";
                        getline(cin, id_baru);
                        id_baru = trim(id_baru);
                        
                        if (id_baru.empty()) {
                            break; // User menekan Enter, lewati update ID
                        }
                        
                        if (id_baru != f.getId()) {
                            // Cek apakah ID baru ini dipakai oleh film LAIN
                            bool bentrok = false;
                            for (Film& film_lain : daftar_film) {
                                if (film_lain.getId() == id_baru) {
                                    bentrok = true;
                                    break;
                                }
                            }
                            
                            if (bentrok) {
                                cout << "ERROR: ID '" << id_baru << "' sudah dipakai! Silakan gunakan ID lain." << endl;
                            } else {
                                f.setId(id_baru); // Update ke ID baru
                                break;
                            }
                        } else {
                            break; // ID baru sama dengan ID lama, aman
                        }
                    }
                    // -------------------------
                    
                    string jud_baru, gen_baru, sut_baru;
                    
                    cout << "Judul Baru (" << f.getJudul() << "): ";
                    getline(cin, jud_baru);
                    jud_baru = trim(jud_baru);
                    if (!jud_baru.empty()) f.setJudul(jud_baru);
                    
                    cout << "Genre Baru (" << f.getGenre() << "): ";
                    getline(cin, gen_baru);
                    gen_baru = trim(gen_baru);
                    if (!gen_baru.empty()) f.setGenre(gen_baru);
                    
                    cout << "Sutradara Baru (" << f.getSutradara() << "): ";
                    getline(cin, sut_baru);
                    sut_baru = trim(sut_baru);
                    if (!sut_baru.empty()) f.setSutradara(sut_baru);
                    
                    cout << "Update berhasil!" << endl;
                    ketemu = true;
                    break;
                }
            }
            if (!ketemu) cout << "ID tidak ditemukan." << endl;
        }
        else if (pilih == "4") {
            cout << "\n--- HAPUS FILM ---" << endl;
            string id_cari;
            cout << "Masukkan ID film yang akan dihapus: ";
            getline(cin, id_cari);
            id_cari = trim(id_cari);
            
            bool ketemu = false;
            for (auto it = daftar_film.begin(); it != daftar_film.end(); ++it) {
                if (it->getId() == id_cari) {
                    daftar_film.erase(it);
                    cout << "Berhasil dihapus!" << endl;
                    ketemu = true;
                    break;
                }
            }
            if (!ketemu) cout << "ID tidak ditemukan." << endl;
        }
        else if (pilih == "5") {
            cout << "\n--- CARI FILM ---" << endl;
            string cari;
            cout << "Masukkan judul film: ";
            getline(cin, cari);
            cari = trim(toLower(cari));
            
            bool ketemu = false;
            
            for (Film& f : daftar_film) {
                string judul_lower = toLower(f.getJudul());
                if (judul_lower.find(cari) != string::npos) {
                    cout << "ID        : " << f.getId() <<  endl;
                    cout << "Judul     : " << f.getJudul() << endl;
                    cout << "Genre     : " << f.getGenre() << endl;
                    cout << "Sutradara : " << f.getSutradara() << endl;
                    ketemu = true;
                }
            }
            if (!ketemu) cout << "Film tidak ditemukan." << endl;
        }
        else if (pilih == "0") {
            cout << "Keluar dari program..." << endl;
            break;
        }
        else {
            cout << "Pilihan tidak valid!" << endl;
        }
    }
    return 0;
}