<?php
// Wajib diletakkan di atas sebelum session_start
require_once 'Film.php';
session_start();

// Gunakan folder 'image' sesuai struktur foldermu
if (!is_dir('image')) {
    mkdir('image', 0777, true);
}

// Inisialisasi array session jika belum ada
if (!isset($_SESSION['daftar_film'])) {
    $_SESSION['daftar_film'] = [];
}

$error_msg = "";
$success_msg = "";

// 1. LOGIKA TAMBAH & UPDATE (POST)
if (isset($_POST['submit'])) {
    $id = trim($_POST['id']); // Ini ID baru (dari input text)
    $judul = trim($_POST['judul']);
    $genre = trim($_POST['genre']);
    $sutradara = trim($_POST['sutradara']);
    $action = $_POST['action'];
    $old_id = $_POST['old_id'] ?? ''; // Menangkap ID lama jika sedang update

    if (empty($id) || empty($judul) || empty($genre) || empty($sutradara)) {
        $error_msg = "Semua kolom teks wajib diisi!";
    } else {
        // Tangani Upload File Gambar ke folder 'image'
        $foto_path = "";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto_path = 'image/' . time() . '_' . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);
        }

        if ($action == 'add') {
            $id_sudah_ada = false;
            foreach ($_SESSION['daftar_film'] as $f) {
                if ($f->getId() == $id) { $id_sudah_ada = true; break; }
            }

            if ($id_sudah_ada) {
                $error_msg = "ID sudah digunakan! Silakan gunakan ID lain.";
            } elseif (empty($foto_path)) {
                $error_msg = "Gambar poster wajib diunggah untuk film baru!";
            } else {
                $_SESSION['daftar_film'][] = new Film($id, $judul, $genre, $sutradara, $foto_path);
                $success_msg = "Film berhasil ditambahkan ke daftar!";
            }
        } 
        elseif ($action == 'update') {
            // Cek apakah user mengganti ID-nya dan apakah ID baru itu bentrok
            $id_bentrok = false;
            if ($id !== $old_id) { 
                foreach ($_SESSION['daftar_film'] as $f) {
                    if ($f->getId() == $id) { 
                        $id_bentrok = true; 
                        break; 
                    }
                }
            }

            if ($id_bentrok) {
                $error_msg = "Update gagal! ID '$id' sudah dipakai oleh film lain.";
            } else {
                // Proses update jika aman
                foreach ($_SESSION['daftar_film'] as $f) {
                    if ($f->getId() == $old_id) { // Cari film berdasarkan old_id
                        $f->setId($id); // Update ke ID baru (pastikan ada method setId di Film.php)
                        $f->setJudul($judul);
                        $f->setGenre($genre);
                        $f->setSutradara($sutradara);
                        if (!empty($foto_path)) {
                            $f->setFoto($foto_path);
                        }
                        $success_msg = "Data film berhasil diperbarui!";
                        break;
                    }
                }
            }
        }
    }
}

// 2. LOGIKA HAPUS (GET)
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    foreach ($_SESSION['daftar_film'] as $index => $f) {
        if ($f->getId() == $id_hapus) {
            unset($_SESSION['daftar_film'][$index]);
            $_SESSION['daftar_film'] = array_values($_SESSION['daftar_film']);
            header("Location: Index.php"); 
            exit;
        }
    }
}

// 3. LOGIKA UNTUK MENGISI FORM UPDATE (GET)
$edit_id = ""; $edit_judul = ""; $edit_genre = ""; $edit_sutradara = "";
$form_action = "add";
if (isset($_GET['edit'])) {
    $form_action = "update";
    foreach ($_SESSION['daftar_film'] as $f) {
        if ($f->getId() == $_GET['edit']) {
            $edit_id = $f->getId();
            $edit_judul = $f->getJudul();
            $edit_genre = $f->getGenre();
            $edit_sutradara = $f->getSutradara();
            break;
        }
    }
}

// 4. LOGIKA PENCARIAN
$data_tampil = $_SESSION['daftar_film'];
if (isset($_GET['cari']) && !empty(trim($_GET['cari']))) {
    $keyword = strtolower(trim($_GET['cari']));
    $data_tampil = [];
    foreach ($_SESSION['daftar_film'] as $f) {
        if (strpos(strtolower($f->getJudul()), $keyword) !== false) {
            $data_tampil[] = $f;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bioskop OOP</title>
    <!-- Import Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6; 
            margin: 0; 
            padding: 30px; 
            color: #333; 
        }
        .header-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 700;
        }
        .container { 
            display: flex; 
            gap: 30px; 
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap;
        }
        .card { 
            background: #ffffff; 
            padding: 25px; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        }
        .form-box { 
            flex: 1; 
            min-width: 300px;
            height: fit-content;
        }
        .table-box { 
            flex: 2; 
            min-width: 600px;
        }
        h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        label {
            font-weight: 500;
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="file"] { 
            width: 100%; 
            margin-bottom: 15px; 
            padding: 10px 12px; 
            box-sizing: border-box; 
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        .info-text {
            display: block;
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #e74c3c;
            font-style: italic;
        }
        .info-text.muted {
            color: #7f8c8d;
        }
        .btn { 
            padding: 10px 18px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .search-bar input {
            margin-bottom: 0;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 14px;
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #f0f0f0; 
        }
        th { 
            background-color: #2c3e50; 
            color: white; 
            font-weight: 500;
        }
        tr:hover { background-color: #f8f9fa; }
        img.poster { 
            width: 70px; 
            height: 100px; 
            object-fit: cover;
            border-radius: 6px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .msg { 
            padding: 15px; 
            margin-bottom: 25px; 
            border-radius: 6px; 
            font-weight: 500;
            max-width: 1200px;
            margin: 0 auto 20px auto;
        }
        .error { background: #fadbd8; color: #c0392b; border-left: 5px solid #e74c3c; }
        .success { background: #d5f5e3; color: #27ae60; border-left: 5px solid #2ecc71; }
        
        .action-links a { 
            text-decoration: none; 
            padding: 6px 12px; 
            border-radius: 4px;
            font-size: 13px;
            margin-right: 5px;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        .action-links a:hover { opacity: 0.8; }
        .edit-link { background-color: #f1c40f; color: #fff; }
        .delete-link { background-color: #e74c3c; color: #fff; }
        .empty-state { text-align: center; color: #7f8c8d; padding: 30px !important; font-style: italic; }
    </style>
</head>
<body>

    <h2 class="header-title">🎬 Sistem Manajemen Bioskop OOP</h2>

    <?php if ($error_msg) echo "<div class='msg error'>⚠️ $error_msg</div>"; ?>
    <?php if ($success_msg) echo "<div class='msg success'>✅ $success_msg</div>"; ?>

    <div class="container">
        <!-- FORM INPUT -->
        <div class="card form-box">
            <h3><?= $form_action == 'update' ? '✏️ Update Film' : '➕ Tambah Film Baru' ?></h3>
            <form action="Index.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?= $form_action ?>">
                
                <?php if($form_action == 'update'): ?>
                    <!-- Wajib: Simpan ID lama untuk dicari di dalam proses PHP -->
                    <input type="hidden" name="old_id" value="<?= $edit_id ?>">
                <?php endif; ?>
                
                <label>ID Film</label>
                <!-- Atribut readonly dihapus agar bisa diedit -->
                <input type="text" name="id" value="<?= $edit_id ?>" placeholder="Contoh: F001">
                <?php if($form_action == 'update') echo "<span class='info-text muted'>*Anda bisa mengganti ID asal tidak dipakai film lain</span>"; ?>
                
                <label>Judul Film</label>
                <input type="text" name="judul" value="<?= $edit_judul ?>" placeholder="Masukkan judul...">
                
                <label>Genre</label>
                <input type="text" name="genre" value="<?= $edit_genre ?>" placeholder="Contoh: Action, Drama...">
                
                <label>Sutradara</label>
                <input type="text" name="sutradara" value="<?= $edit_sutradara ?>" placeholder="Nama sutradara...">
                
                <label>Poster (Gambar)</label>
                <input type="file" name="foto" accept="image/*">
                <?php if($form_action == 'update') echo "<span class='info-text muted'>*Kosongkan jika tidak ingin mengganti poster saat ini</span>"; ?>
                
                <div style="margin-top: 15px;">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <?= $form_action == 'update' ? 'Simpan Perubahan' : 'Simpan Data' ?>
                    </button>
                    <?php if($form_action == 'update') echo '<a href="Index.php" class="btn btn-danger">Batal</a>'; ?>
                </div>
            </form>
        </div>

        <!-- TABEL DATA -->
        <div class="card table-box">
            <h3>📑 Daftar Film</h3>
            
            <form action="Index.php" method="GET" class="search-bar">
                <input type="text" name="cari" placeholder="Cari judul film..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="Index.php" class="btn btn-secondary">Reset</a>
            </form>

            <table>
                <thead>
                    <tr>
                        <th width="90">Poster</th>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Sutradara</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_GET['cari']) && !empty(trim($_GET['cari']))): ?>
                        <tr>
                            <td colspan="6" style="background-color: #e8f4f8; color: #2c3e50; font-weight: 500; font-style: italic; padding: 10px 15px; border-bottom: 2px solid #3498db;">
                                🔍 Hasil pencarian untuk: "<strong><?= htmlspecialchars($_GET['cari']) ?></strong>"
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if (empty($data_tampil)): ?>
                        <tr><td colspan="6" class="empty-state">Belum ada data film yang tersimpan atau ditemukan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($data_tampil as $f): ?>
                        <tr>
                            <td>
                                <?php if(!empty($f->getFoto()) && file_exists($f->getFoto())): ?>
                                    <img src="<?= $f->getFoto() ?>" alt="Poster" class="poster">
                                <?php else: ?>
                                    <i>No Image</i>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= $f->getId() ?></strong></td>
                            <td><?= $f->getJudul() ?></td>
                            <td><span style="background:#e8f4f8; padding:3px 8px; border-radius:12px; font-size:12px; color:#2980b9;"><?= $f->getGenre() ?></span></td>
                            <td><?= $f->getSutradara() ?></td>
                            <td class="action-links">
                                <a href="Index.php?edit=<?= $f->getId() ?>" class="edit-link">Edit</a>
                                <a href="Index.php?hapus=<?= $f->getId() ?>" class="delete-link" onclick="return confirm('Yakin ingin menghapus film <?= $f->getJudul() ?>?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>