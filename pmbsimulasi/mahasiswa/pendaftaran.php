<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];
$message = "";

if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];

    // upload KTP
    $ktp = $_FILES['ktp']['name'];
    $tmp_ktp = $_FILES['ktp']['tmp_name'];
    move_uploaded_file($tmp_ktp, "../uploads/gambar/".$ktp);

    // upload ijazah
    $ijazah = $_FILES['ijazah']['name'];
    $tmp_ijazah = $_FILES['ijazah']['tmp_name'];
    move_uploaded_file($tmp_ijazah, "../uploads/gambar/".$ijazah);

    // simpan database
    $query = mysqli_query($conn,
    "INSERT INTO pendaftar
    (user_id, nama_lengkap, alamat, asal_sekolah, jurusan_pilihan, file_ktp, file_ijazah, status)
    VALUES
    ('$user_id','$nama','$alamat','$sekolah','$jurusan','$ktp','$ijazah','pending')");

    if($query){
        $message = "Pendaftaran berhasil dikirim!";
    } else {
        $message = "Gagal mengirim pendaftaran!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pendaftaran PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#dbeafe,#fce7f3,#e0f2fe);
    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
}

/* NAVBAR */
.navbar-custom{
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(18px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* FORM CARD */
.card-form{
    background: rgba(255,255,255,0.65);
    backdrop-filter: blur(20px);

    border-radius: 30px;
    padding: 35px;

    border: 2px solid rgba(99,102,241,0.15);

    box-shadow:
        0 15px 35px rgba(0,0,0,0.12),
        inset 0 1px 0 rgba(255,255,255,0.6);

    transition: 0.3s;
}

.card-form:hover{
    transform: translateY(-5px);
}

/* TITLE */
.title{
    font-weight:800;
    color:#312e81;
}

/* INPUT */
.form-control{
    border-radius:14px;
    padding:12px;
    border:none;
    background:#f8fafc;
}

.form-control:focus{
    box-shadow:0 0 10px rgba(99,102,241,0.3);
    border:none;
}

/* BUTTON */
.btn-premium{
    border-radius:14px;
    padding:12px;
    font-weight:600;
    transition:0.3s;
}

.btn-premium:hover{
    transform:scale(1.02);
}

/* INFO BOX */
.info-box{
    background: linear-gradient(135deg,#6366f1,#ec4899);
    color:white;
    padding:25px;
    border-radius:25px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}

/* FOOTER */
footer{
    text-align:center;
    padding:25px;
    margin-top:40px;
    color:#64748b;
}

</style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-custom px-4">
<div class="container-fluid">

    <a class="navbar-brand fw-bold">
        🎓 PMB Universitas Nusantara
    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="fw-semibold">
            👋 <?= $_SESSION['nama']; ?>
        </span>

        <a href="dashboard.php" class="btn btn-secondary btn-sm">
            Dashboard
        </a>

        <a href="../logout.php" class="btn btn-danger btn-sm">
            Logout
        </a>

    </div>

</div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-10">

    <!-- INFO -->
    <div class="info-box mb-4">
        <h3 class="fw-bold">
            📝 Formulir Pendaftaran Mahasiswa Baru
        </h3>

        <p class="mb-0">
            Lengkapi seluruh data dengan benar dan upload dokumen yang diperlukan.
        </p>
    </div>

    <!-- ALERT -->
    <?php if($message != "") { ?>

        <div class="alert alert-info text-center shadow-sm">
            <?= $message; ?>
        </div>

    <?php } ?>

    <!-- FORM -->
    <div class="card-form">

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="fw-semibold mb-2">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="fw-semibold mb-2">
                        Asal Sekolah
                    </label>

                    <input type="text"
                           name="sekolah"
                           class="form-control"
                           required>
                </div>

            </div>

            <div class="mb-4">
                <label class="fw-semibold mb-2">
                    Alamat
                </label>

                <textarea name="alamat"
                          class="form-control"
                          rows="4"
                          required></textarea>
            </div>

            <div class="mb-4">
                <label class="fw-semibold mb-2">
                    Jurusan Pilihan
                </label>

                <input type="text"
                       name="jurusan"
                       class="form-control"
                       required>
            </div>

            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="fw-semibold mb-2">
                        Upload KTP
                    </label>

                    <input type="file"
                           name="ktp"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="fw-semibold mb-2">
                        Upload Ijazah
                    </label>

                    <input type="file"
                           name="ijazah"
                           class="form-control"
                           required>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="d-grid gap-2">

                <button type="submit"
                        name="submit"
                        class="btn btn-dark btn-premium">

                    🚀 Kirim Pendaftaran

                </button>

                <a href="dashboard.php"
                   class="btn btn-outline-secondary btn-premium">

                    ⬅ Kembali ke Dashboard

                </a>

            </div>

        </form>

    </div>

</div>

</div>

</div>

<!-- FOOTER -->
<footer>
    © 2026 PMB Universitas Nusantara • Sistem Pendaftaran Mahasiswa Baru
</footer>

</body>
</html>