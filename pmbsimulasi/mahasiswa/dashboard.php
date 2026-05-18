<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['id'];

$data = mysqli_query($conn, "SELECT * FROM pendaftar WHERE user_id='$id'");
$pendaftar = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Mahasiswa PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#dbeafe,#fce7f3,#e0f2fe);
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
}

/* NAVBAR */
.navbar{
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(18px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* SIDEBAR */
.sidebar{
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(18px);
    border-radius: 25px;
    padding: 22px;
    min-height: 85vh;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    border: 1px solid rgba(255,255,255,0.6);
}

/* MENU */
.menu a{
    display:block;
    padding:14px;
    margin:10px 0;
    border-radius:14px;
    text-decoration:none;
    color:#1e293b;
    transition:0.3s;
    font-weight:500;
}

.menu a:hover{
    background: linear-gradient(135deg,#6366f1,#ec4899);
    color:white;
    transform: translateX(8px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.3);
}

/* CARD */
.card-box{
    background: rgba(255,255,255,0.65);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 25px;

    border: 2px solid rgba(99,102,241,0.15);

    box-shadow:
        0 15px 35px rgba(0,0,0,0.12),
        inset 0 1px 0 rgba(255,255,255,0.6);

    transition: all 0.35s ease;
}

.card-box:hover{
    transform: translateY(-10px) scale(1.02);

    box-shadow:
        0 25px 50px rgba(0,0,0,0.18),
        0 0 25px rgba(99,102,241,0.25);
}

/* WELCOME */
.welcome-box{
    background: linear-gradient(135deg,#6366f1,#ec4899);
    color:white;
    border-radius:25px;
    padding:30px;

    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* STATUS */
.badge{
    padding:8px 14px;
    border-radius: 30px;
    font-weight: 600;
    font-size:14px;
}

/* FOOTER */
footer{
    text-align:center;
    padding:25px;
    margin-top:40px;
    color:#64748b;
}

/* INFO BOX */
.info-item{
    padding:10px 0;
    border-bottom:1px solid rgba(0,0,0,0.05);
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4">
<div class="container-fluid">

    <a class="navbar-brand fw-bold">
        🎓 PMB Universitas Nusantara
    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="fw-semibold">
            👋 <?= $_SESSION['nama']; ?>
        </span>

        <a href="../logout.php" class="btn btn-danger btn-sm">
            Logout
        </a>

    </div>

</div>
</nav>

<!-- CONTENT -->
<div class="container-fluid mt-4">

<div class="row">

<!-- SIDEBAR -->
<div class="col-md-3 mb-4">

<div class="sidebar">

    <h4 class="fw-bold mb-4">📚 Menu Mahasiswa</h4>

    <div class="menu">

        <a href="dashboard.php">
            <i class="bi bi-house-door-fill"></i>
            Dashboard
        </a>

        <a href="pendaftaran.php">
            <i class="bi bi-file-earmark-text-fill"></i>
            Pendaftaran
        </a>

        <a href="upload_berkas.php">
            <i class="bi bi-upload"></i>
            Upload Berkas
        </a>

        <a href="pengumuman.php">
            <i class="bi bi-megaphone-fill"></i>
            Pengumuman
        </a>

        <a href="ospek.php">
            <i class="bi bi-mortarboard-fill"></i>
            Daftar Ulang
        </a>

    </div>

</div>

</div>

<!-- MAIN -->
<div class="col-md-9">

<!-- WELCOME -->
<div class="welcome-box mb-4">

    <h2 class="fw-bold">
        Selamat Datang, <?= $_SESSION['nama']; ?> 👋
    </h2>

    <p class="mb-0">
        Sistem Penerimaan Mahasiswa Baru • Universitas Nusantara
    </p>

</div>

<!-- STATUS -->
<div class="card-box mb-4">

    <h4 class="fw-bold mb-4">
        📊 Status Pendaftaran
    </h4>

    <?php if($pendaftar){ ?>

        <div class="info-item">
            <strong>Nama Lengkap</strong><br>
            <?= $pendaftar['nama_lengkap']; ?>
        </div>

        <div class="info-item">
            <strong>Status Seleksi</strong><br><br>

            <?php if($pendaftar['status']=='lulus'){ ?>

                <span class="badge bg-success">
                    LULUS
                </span>

            <?php } elseif($pendaftar['status']=='ditolak'){ ?>

                <span class="badge bg-danger">
                    DITOLAK
                </span>

            <?php } else { ?>

                <span class="badge bg-warning text-dark">
                    PENDING
                </span>

            <?php } ?>

        </div>

        <?php if($pendaftar['status']=='lulus'){ ?>

            <a href="ospek.php" class="btn btn-success w-100 mt-4">
                🎓 Lanjut Daftar Ulang / OSPEK
            </a>

        <?php } ?>

    <?php } else { ?>

        <div class="alert alert-danger">
            Anda belum melakukan pendaftaran.
        </div>

        <a href="pendaftaran.php" class="btn btn-dark w-100">
            📝 Daftar Sekarang
        </a>

    <?php } ?>

</div>

<!-- INFO -->
<div class="card-box">

    <h4 class="fw-bold mb-4">
        📢 Informasi Kampus
    </h4>

    <div class="info-item">
        🎓 Jadwal OSPEK diumumkan setelah dinyatakan lulus.
    </div>

    <div class="info-item">
        📄 Lengkapi seluruh berkas sebelum batas waktu.
    </div>

    <div class="info-item">
        📢 Cek pengumuman secara berkala melalui dashboard.
    </div>

    <div class="info-item">
        ☎ Hubungi admin PMB jika mengalami kendala.
    </div>

</div>

</div>

</div>

</div>

<!-- FOOTER -->
<footer>
    © 2026 PMB Universitas Nusantara • Sistem Akademik Modern
</footer>

</body>
</html>