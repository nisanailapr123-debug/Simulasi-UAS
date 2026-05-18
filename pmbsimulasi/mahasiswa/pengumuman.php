<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];

// ambil data pendaftar
$data = mysqli_query($conn, "SELECT * FROM pendaftar WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pengumuman PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#dbeafe,#ede9fe,#fbcfe8);
    font-family:'Poppins',sans-serif;
    min-height:100vh;
}

/* NAVBAR */
.navbar-custom{
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(12px);
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* HEADER */
.page-header{
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(15px);
    border-radius:30px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

/* CARD */
.card-box{
    background: rgba(255,255,255,0.30);
    backdrop-filter: blur(18px);
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

/* STATUS BOX */
.status-box{
    border-radius:20px;
    padding:25px;
    color:white;
    margin-top:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.bg-success-custom{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.bg-danger-custom{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.bg-warning-custom{
    background:linear-gradient(135deg,#f59e0b,#d97706);
}

/* INFO CARD */
.info-card{
    background: rgba(255,255,255,0.5);
    border-radius:20px;
    padding:20px;
    margin-top:20px;
    border:1px solid rgba(255,255,255,0.4);
}

/* BUTTON */
.btn-modern{
    border-radius:14px;
    padding:10px 18px;
    font-weight:600;
}

/* FOOTER */
.footer{
    margin-top:60px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(10px);
    padding:20px;
    text-align:center;
    color:#475569;
    box-shadow:0 -4px 15px rgba(0,0,0,0.05);
}

.title{
    font-weight:800;
    color:#4c1d95;
}

.subtitle{
    color:#64748b;
}

.badge-modern{
    padding:8px 15px;
    border-radius:50px;
    font-size:13px;
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

        <a href="dashboard.php" class="btn btn-light btn-sm btn-modern">
            Dashboard
        </a>

        <a href="../logout.php" class="btn btn-danger btn-sm btn-modern">
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
                <h2 class="title">
                    📢 Pengumuman Hasil Seleksi
                </h2>

                <p class="subtitle mb-0">
                    Informasi status seleksi penerimaan mahasiswa baru
                </p>
            </div>

            <a href="dashboard.php" class="btn btn-secondary btn-modern mt-3 mt-md-0">
                ⬅ Kembali
            </a>

        </div>

    </div>

    <!-- CARD -->
    <div class="card-box">

        <?php if(!$row){ ?>

            <div class="alert alert-warning text-center p-4 rounded-4">

                <h5>⚠ Anda belum melakukan pendaftaran</h5>

                <p class="mb-0">
                    Silakan lakukan pendaftaran terlebih dahulu.
                </p>

            </div>

        <?php } else { ?>

            <!-- IDENTITAS -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                <div>
                    <h4 class="fw-bold">
                        Halo, <?= $row['nama_lengkap']; ?> 👋
                    </h4>

                    <p class="text-muted mb-0">
                        Berikut adalah hasil seleksi PMB Anda
                    </p>
                </div>

                <?php if($row['status'] == "lulus"){ ?>
                    <span class="badge bg-success badge-modern">
                        LULUS
                    </span>

                <?php } elseif($row['status'] == "ditolak"){ ?>
                    <span class="badge bg-danger badge-modern">
                        TIDAK LULUS
                    </span>

                <?php } else { ?>
                    <span class="badge bg-warning text-dark badge-modern">
                        PENDING
                    </span>
                <?php } ?>

            </div>

            <!-- STATUS -->
            <?php if($row['status'] == "lulus"){ ?>

                <div class="status-box bg-success-custom">

                    <h3>🎉 SELAMAT!</h3>

                    <p class="mb-0">
                        Anda dinyatakan <b>LULUS</b> seleksi PMB Universitas Nusantara.
                        Silakan lanjut ke tahap daftar ulang / OSPEK.
                    </p>

                </div>

            <?php } elseif($row['status'] == "ditolak"){ ?>

                <div class="status-box bg-danger-custom">

                    <h3>❌ MOHON MAAF</h3>

                    <p class="mb-0">
                        Anda belum berhasil pada seleksi PMB tahun ini.
                        Tetap semangat dan terus berkembang.
                    </p>

                </div>

            <?php } else { ?>

                <div class="status-box bg-warning-custom">

                    <h3>⏳ MASIH DIPROSES</h3>

                    <p class="mb-0">
                        Data Anda sedang dalam tahap verifikasi admin.
                        Silakan cek halaman ini secara berkala.
                    </p>

                </div>

            <?php } ?>

            <!-- INFORMASI -->
            <div class="row mt-4">

                <div class="col-md-6 mb-3">

                    <div class="info-card">

                        <h6 class="fw-bold">
                            🏫 Asal Sekolah
                        </h6>

                        <p class="mb-0 text-muted">
                            <?= $row['asal_sekolah']; ?>
                        </p>

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <div class="info-card">

                        <h6 class="fw-bold">
                            🎓 Jurusan Pilihan
                        </h6>

                        <p class="mb-0 text-muted">
                            <?= $row['jurusan_pilihan']; ?>
                        </p>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <?php if($row['status'] == "lulus"){ ?>

                <a href="ospek.php"
                class="btn btn-success btn-lg w-100 mt-4 btn-modern">

                    🎓 Lanjut Daftar Ulang / OSPEK

                </a>

            <?php } ?>

        <?php } ?>

    </div>

</div>

<!-- FOOTER -->
<div class="footer">

    © 2026 PMB Universitas Nusantara • Sistem Informasi Penerimaan Mahasiswa Baru

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>