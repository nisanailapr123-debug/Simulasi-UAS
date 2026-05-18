<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];

// ambil data lama
$data = mysqli_query($conn, "SELECT * FROM pendaftar WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($data);

$message = "";

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];

    // upload KTP
    if(!empty($_FILES['ktp']['name'])){
        $ktp = $_FILES['ktp']['name'];
        $tmp = $_FILES['ktp']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/gambar/".$ktp);
    } else {
        $ktp = $row['file_ktp'];
    }

    // upload ijazah
    if(!empty($_FILES['ijazah']['name'])){
        $ijazah = $_FILES['ijazah']['name'];
        $tmp2 = $_FILES['ijazah']['tmp_name'];
        move_uploaded_file($tmp2, "../uploads/gambar/".$ijazah);
    } else {
        $ijazah = $row['file_ijazah'];
    }

    // update data
    $update = mysqli_query($conn,
    "UPDATE pendaftar SET
        nama_lengkap='$nama',
        alamat='$alamat',
        asal_sekolah='$sekolah',
        jurusan_pilihan='$jurusan',
        file_ktp='$ktp',
        file_ijazah='$ijazah'
    WHERE user_id='$user_id'");

    if($update){
        $message = "✅ Data berhasil diperbarui!";
    } else {
        $message = "❌ Gagal update data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Pendaftaran PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:
    linear-gradient(135deg,#dbeafe,#ede9fe,#fbcfe8);
    min-height:100vh;
}

/* NAVBAR */
.navbar-custom{
    background:rgba(255,255,255,0.25);
    backdrop-filter:blur(12px);
    box-shadow:0 4px 20px rgba(0,0,0,0.08);
}

/* HEADER */
.page-header{
    background:rgba(255,255,255,0.25);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

/* CARD */
.card-box{
    background:rgba(255,255,255,0.30);
    backdrop-filter:blur(18px);
    border-radius:30px;
    padding:35px;
    border:1px solid rgba(255,255,255,0.3);
    box-shadow:
    0 10px 40px rgba(0,0,0,0.10),
    inset 0 1px 0 rgba(255,255,255,0.5);

    transition:0.3s;
}

.card-box:hover{
    transform:translateY(-5px);
}

/* INPUT */
.form-control{
    border-radius:15px;
    padding:12px;
    border:none;
    background:rgba(255,255,255,0.8);
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.form-control:focus{
    box-shadow:0 0 0 0.2rem rgba(139,92,246,0.3);
}

/* BUTTON */
.btn-premium{
    border:none;
    border-radius:15px;
    padding:12px;
    font-weight:600;
    background:linear-gradient(135deg,#4f46e5,#9333ea);
    transition:0.3s;
}

.btn-premium:hover{
    transform:scale(1.02);
    background:linear-gradient(135deg,#4338ca,#7e22ce);
}

/* FILE BOX */
.file-box{
    background:rgba(255,255,255,0.4);
    border-radius:18px;
    padding:15px;
    margin-bottom:15px;
    border:1px solid rgba(255,255,255,0.3);
}

/* FOOTER */
.footer{
    margin-top:50px;
    background:rgba(255,255,255,0.2);
    backdrop-filter:blur(12px);
    padding:20px;
    text-align:center;
    color:#475569;
    box-shadow:0 -4px 15px rgba(0,0,0,0.05);
}

.label-title{
    font-weight:600;
    margin-bottom:8px;
}

.subtitle{
    color:#64748b;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
<div class="container">

    <a class="navbar-brand fw-bold">
        🎓 PMB Universitas Nusantara
    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="fw-semibold">
            👤 <?= $_SESSION['nama']; ?>
        </span>

        <a href="dashboard.php" class="btn btn-light btn-sm">
            Dashboard
        </a>

        <a href="../logout.php" class="btn btn-danger btn-sm">
            Logout
        </a>

    </div>

</div>
</nav>

<!-- CONTENT -->
<div class="container py-5">

    <!-- HEADER -->
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h2 class="fw-bold">
                    ✏ Edit Data & Upload Berkas
                </h2>

                <p class="subtitle mb-0">
                    Lengkapi dan perbarui data pendaftaran PMB Anda
                </p>
            </div>

            <a href="dashboard.php" class="btn btn-secondary mt-3 mt-md-0">
                ⬅ Kembali
            </a>

        </div>

    </div>

    <!-- ALERT -->
    <?php if($message != "") { ?>
        <div class="alert alert-info alert-dismissible fade show">
            <?= $message; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <!-- FORM -->
    <div class="card-box">

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="label-title">
                            👤 Nama Lengkap
                        </label>

                        <input type="text"
                        name="nama"
                        class="form-control"
                        value="<?= $row['nama_lengkap'] ?? '' ?>"
                        required>
                    </div>

                    <div class="mb-4">
                        <label class="label-title">
                            🏫 Asal Sekolah
                        </label>

                        <input type="text"
                        name="sekolah"
                        class="form-control"
                        value="<?= $row['asal_sekolah'] ?? '' ?>">
                    </div>

                    <div class="mb-4">
                        <label class="label-title">
                            🎓 Jurusan Pilihan
                        </label>

                        <input type="text"
                        name="jurusan"
                        class="form-control"
                        value="<?= $row['jurusan_pilihan'] ?? '' ?>">
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-6">

                    <div class="mb-4">
                        <label class="label-title">
                            🏠 Alamat
                        </label>

                        <textarea
                        name="alamat"
                        class="form-control"
                        rows="5"><?= $row['alamat'] ?? '' ?></textarea>
                    </div>

                </div>

            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-4">
                📂 Upload Dokumen
            </h5>

            <!-- FILE KTP -->
            <div class="file-box">

                <label class="label-title">
                    🪪 Upload KTP
                </label>

                <input type="file"
                name="ktp"
                class="form-control">

                <small class="text-muted">
                    File saat ini:
                    <?= $row['file_ktp'] ?? 'Belum ada file'; ?>
                </small>

            </div>

            <!-- FILE IJAZAH -->
            <div class="file-box">

                <label class="label-title">
                    📄 Upload Ijazah
                </label>

                <input type="file"
                name="ijazah"
                class="form-control">

                <small class="text-muted">
                    File saat ini:
                    <?= $row['file_ijazah'] ?? 'Belum ada file'; ?>
                </small>

            </div>

            <!-- BUTTON -->
            <button type="submit"
            name="update"
            class="btn btn-premium w-100 mt-4 text-white">

                💾 Simpan Perubahan

            </button>

        </form>

    </div>

</div>

<!-- FOOTER -->
<div class="footer">

    © 2026 PMB Universitas Nusantara • Sistem Informasi Mahasiswa Baru

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>