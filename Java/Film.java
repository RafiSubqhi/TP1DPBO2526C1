public class Film {
    private String idFilm;
    private String judul;
    private String genre;
    private String sutradara;

    public Film(String idFilm, String judul, String genre, String sutradara) {
        this.idFilm = idFilm; 
        this.judul = judul; 
        this.genre = genre; 
        this.sutradara = sutradara;
    }

    // Getters
    public String getId() { return idFilm; }
    public String getJudul() { return judul; }
    public String getGenre() { return genre; }
    public String getSutradara() { return sutradara; }

    // Setters
    public void setId(String idFilm) { this.idFilm = idFilm; } // Tambahan setter ID
    public void setJudul(String judul) { this.judul = judul; }
    public void setGenre(String genre) { this.genre = genre; }
    public void setSutradara(String sutradara) { this.sutradara = sutradara; }
}