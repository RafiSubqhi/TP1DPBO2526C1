<?php
class Film {
    private $id_film;
    private $judul;
    private $genre;
    private $sutradara;
    private $foto; // Atribut untuk path gambar lokal

    public function __construct($id, $jud, $gen, $sut, $foto) {
        $this->id_film = $id;
        $this->judul = $jud;
        $this->genre = $gen;
        $this->sutradara = $sut;
        $this->foto = $foto;
    }

    public function getId() { return $this->id_film; }
    public function getJudul() { return $this->judul; }
    public function getGenre() { return $this->genre; }
    public function getSutradara() { return $this->sutradara; }
    public function getFoto() { return $this->foto; }

    // Tambahan Setter untuk ID agar bisa di-update
    public function setId($id) { $this->id_film = $id; }
    
    public function setJudul($jud) { $this->judul = $jud; }
    public function setGenre($gen) { $this->genre = $gen; }
    public function setSutradara($sut) { $this->sutradara = $sut; }
    public function setFoto($foto) { $this->foto = $foto; }
}
?>