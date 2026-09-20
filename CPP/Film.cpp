#include <iostream>
#include <string>

using namespace std;

class Film {
private:
    string id_film;
    string judul;
    string genre;
    string sutradara;

public:
    // Konstruktor
    Film(string id, string jud, string gen, string sut) {
        id_film = id;
        judul = jud;
        genre = gen;
        sutradara = sut;
    }

    // Getters
    string getId() { return id_film; }
    string getJudul() { return judul; }
    string getGenre() { return genre; }
    string getSutradara() { return sutradara; }

    // Setters
    void setId(string id) { id_film = id; } // Tambahan setter ID
    void setJudul(string jud) { judul = jud; }
    void setGenre(string gen) { genre = gen; }
    void setSutradara(string sut) { sutradara = sut; }
};