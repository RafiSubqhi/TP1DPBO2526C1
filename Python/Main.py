from Film import Film

def main():
    daftar_film = []
    
    while True:
        print("\n=== MENU BIOSKOP ===")
        print("1. Tambah Film\n2. Tampilkan Film\n3. Update Film\n4. Hapus Film\n5. Cari Film\n0. Keluar")
        pilih = input("Pilih menu: ")
        
        if pilih == '1':
            print("\n--- TAMBAH FILM ---")
            
            # 1. Kunci input ID agar tidak boleh kosong
            while True:
                id_f = input("ID: ").strip()
                if not id_f:
                    print("ERROR: ID tidak boleh kosong!")
                else:
                    break
            
            # 2. Cek apakah ID sudah ada di daftar
            id_sudah_ada = False
            for f in daftar_film:
                if f.get_id() == id_f:
                    id_sudah_ada = True
                    break
            
            if id_sudah_ada:
                print("ERROR: ID sudah digunakan! Silakan masukkan ID yang unik.")
            else:
                # 3. Kunci input Judul, Genre, dan Sutradara agar tidak boleh kosong
                while True:
                    jud = input("Judul: ").strip()
                    if not jud: 
                        print("ERROR: Judul tidak boleh kosong!")
                    else: 
                        break
                    
                while True:
                    gen = input("Genre: ").strip()
                    if not gen: 
                        print("ERROR: Genre tidak boleh kosong!")
                    else: 
                        break
                    
                while True:
                    sut = input("Sutradara: ").strip()
                    if not sut: 
                        print("ERROR: Sutradara tidak boleh kosong!")
                    else: 
                        break
                    
                daftar_film.append(Film(id_f, jud, gen, sut))
                print("Berhasil ditambah!")
            
        elif pilih == '2':
            if not daftar_film:
                print("\nData film masih kosong.")
            else:
                print("\n--- DAFTAR FILM ---")
                for f in daftar_film:
                    print(f"ID        : {f.get_id()}")
                    print(f"Judul     : {f.get_judul()}")
                    print(f"Genre     : {f.get_genre()}")
                    print(f"Sutradara : {f.get_sutradara()}\n")
                
        elif pilih == '3':
            print("\n--- UPDATE FILM ---")
            id_cari = input("Masukkan ID film yang akan diupdate: ").strip()
            for f in daftar_film:
                if f.get_id() == id_cari:
                    print("(Tekan Enter saja jika tidak ingin mengubah data)")
                    
                    # --- LOGIKA UPDATE ID ---
                    while True:
                        id_baru = input(f"ID Baru ({f.get_id()}): ").strip()
                        if id_baru == "": 
                            break # User menekan Enter, lewati update ID
                        
                        if id_baru != f.get_id():
                            # Cek apakah ID baru ini dipakai oleh film LAIN
                            bentrok = False
                            for film_lain in daftar_film:
                                if film_lain.get_id() == id_baru:
                                    bentrok = True
                                    break
                            
                            if bentrok:
                                print(f"ERROR: ID '{id_baru}' sudah dipakai! Silakan gunakan ID lain.")
                            else:
                                f.set_id(id_baru) # Update ke ID baru
                                break
                        else:
                            break # ID baru sama dengan ID lama, aman
                    # -------------------------
                    
                    jud_baru = input(f"Judul Baru ({f.get_judul()}): ").strip()
                    if jud_baru != "": 
                        f.set_judul(jud_baru)
                        
                    gen_baru = input(f"Genre Baru ({f.get_genre()}): ").strip()
                    if gen_baru != "": 
                        f.set_genre(gen_baru)
                        
                    sut_baru = input(f"Sutradara Baru ({f.get_sutradara()}): ").strip()
                    if sut_baru != "": 
                        f.set_sutradara(sut_baru)
                        
                    print("Update berhasil!")
                    break
            else: 
                print("ID tidak ditemukan.")
            
        elif pilih == '4':
            print("\n--- HAPUS FILM ---")
            id_cari = input("Masukkan ID film yang akan dihapus: ").strip()
            for i, f in enumerate(daftar_film):
                if f.get_id() == id_cari:
                    del daftar_film[i]
                    print("Berhasil dihapus!")
                    break
            else: 
                print("ID tidak ditemukan.")
            
        elif pilih == '5':
            print("\n--- CARI FILM ---")
            cari = input("Masukkan judul film: ").strip().lower()
            ketemu = False
            for f in daftar_film:
                if cari in f.get_judul().lower(): 
                    print(f"Id        : {f.get_id()}")
                    print(f"Judul     : {f.get_judul()}")
                    print(f"Genre     : {f.get_genre()}")
                    print(f"Sutradara : {f.get_sutradara()}")
                    ketemu = True
            
            if not ketemu:
                print("Film tidak ditemukan.")
                    
        elif pilih == '0':
            print("Keluar dari program...")
            break
        else:
            print("Pilihan tidak valid!")

if __name__ == "__main__":
    main()