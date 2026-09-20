class Film:
    def __init__(self, id_film, judul, genre, sutradara):
        self.__id_film = id_film
        self.__judul = judul
        self.__genre = genre
        self.__sutradara = sutradara

    # --- GETTERS ---
    def get_id(self): 
        return self.__id_film
        
    def get_judul(self): 
        return self.__judul
        
    def get_genre(self): 
        return self.__genre
        
    def get_sutradara(self): 
        return self.__sutradara

    # --- SETTERS ---
    # Ini fungsi yang tadi bikin error karena belum ada
    def set_id(self, id_film): 
        self.__id_film = id_film
        
    def set_judul(self, judul): 
        self.__judul = judul
        
    def set_genre(self, genre): 
        self.__genre = genre
        
    def set_sutradara(self, sutradara): 
        self.__sutradara = sutradara