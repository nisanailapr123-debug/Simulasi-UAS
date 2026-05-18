<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

/* STATISTIK */
$pendaftar = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pendaftar"));
$lulus = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pendaftar WHERE status='lulus'"));
$aktif = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pendaftar WHERE status_ospek='aktif'"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pendaftar WHERE status='pending'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins', sans-serif;
}

body{
    background: linear-gradient(-45deg,#dbeafe,#ede9fe,#fbcfe8,#c7d2fe);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    min-height:100vh;
}

@keyframes gradientBG{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* NAVBAR */
.navbar-custom{
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(15px);
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

/* HEADER */
.hero-box{
    background: rgba(255,255,255,0.30);
    backdrop-filter: blur(18px);
    border-radius:30px;
    padding:35px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    margin-bottom:30px;
}

.title{
    font-weight:800;
    color:#4c1d95;
}

.subtitle{
    color:#64748b;
}

/* STAT */
.stat-card{
    border-radius:25px;
    padding:25px;
    color:white;
    transition:0.3s;
    box-shadow:0 12px 30px rgba(0,0,0,0.12);
    position:relative;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-8px) scale(1.02);
}

.stat-card::before{
    content:'';
    position:absolute;
    width:120px;
    height:120px;
    background:rgba(255,255,255,0.15);
    border-radius:50%;
    top:-30px;
    right:-30px;
}

.bg1{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
}

.bg2{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.bg3{
    background:linear-gradient(135deg,#f97316,#ef4444);
}

.bg4{
    background:linear-gradient(135deg,#06b6d4,#3b82f6);
}

.stat-icon{
    font-size:40px;
    opacity:0.9;
}

/* MENU */
.card-box{
    background: rgba(255,255,255,0.28);
    backdrop-filter: blur(18px);
    border-radius:28px;
    padding:35px 25px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    transition:0.3s;
    border:1px solid rgba(255,255,255,0.2);
    height:100%;
}

.card-box:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

.menu-icon{
    width:85px;
    height:85px;
    margin:auto;
    border-radius:25px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    color:white;
    margin-bottom:20px;
}

.menu1{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
}

.menu2{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.menu3{
    background:linear-gradient(135deg,#f97316,#ef4444);
}

.menu4{
    background:linear-gradient(135deg,#ec4899,#d946ef);
}

.menu5{
    background:linear-gradient(135deg,#06b6d4,#3b82f6);
}

.card-title{
    font-weight:700;
    color:#1e293b;
}

.card-text{
    color:#64748b;
    font-size:14px;
}

/* BUTTON */
.btn-modern{
    border-radius:14px;
    padding:10px 18px;
    font-weight:600;
}

/* TOAST */
.toast-container{
    position:fixed;
    top:20px;
    right:20px;
    z-index:9999;
}

.toast-custom{
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);
    border-radius:18px;
    padding:15px 22px;
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
    animation:slideIn 0.5s ease;
}

@keyframes slideIn{
    from{
        opacity:0;
        transform:translateX(100%);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

/* FOOTER */
.footer{
    margin-top:60px;
    background:rgba(255,255,255,0.2);
    backdrop-filter:blur(10px);
    padding:25px;
    text-align:center;
    color:#475569;
    box-shadow:0 -5px 20px rgba(0,0,0,0.05);
}

</style>
</head>

<body>

<!-- TOAST -->
<div class="toast-container">

<?php if(isset($_SESSION['login_success'])) { ?>

<div class="toast-custom">
    🎉 Selamat datang,
    <b><?= $_SESSION['nama']; ?></b>
</div>

<?php unset($_SESSION['login_success']); } ?>

</div>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-custom py-3">
<div class="container">

    <a class="navbar-brand fw-bold">
        ⚙ PMB ADMIN PANEL
    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="fw-semibold">
            👨‍💼 <?= $_SESSION['nama']; ?>
        </span>

        <a href="../logout.php" class="btn btn-danger btn-modern btn-sm">
            Logout
        </a>

    </div>

</div>
</nav>

<!-- CONTENT -->
<div class="container py-5">

<!-- HERO -->
<div class="hero-box">

<div class="row align-items-center">

<div class="col-md-8">

    <h1 class="title">
        Dashboard Admin 🚀
    </h1>

    <p class="subtitle mt-3">
        Kelola seluruh sistem Penerimaan Mahasiswa Baru dengan cepat,
        modern, dan efisien.
    </p>

</div>

<div class="col-md-4 text-center">

    <i class="bi bi-mortarboard-fill"
       style="font-size:90px;color:#8b5cf6;">
    </i>

</div>

</div>

</div>

<!-- STATISTIK -->
<div class="row g-4 mb-5">

<div class="col-md-3">

<div class="stat-card bg1">

<div class="d-flex justify-content-between align-items-center">

<div>
<h2><?= $pendaftar ?></h2>
<p>Total Pendaftar</p>
</div>

<div class="stat-icon">
<i class="bi bi-people-fill"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="stat-card bg2">

<div class="d-flex justify-content-between align-items-center">

<div>
<h2><?= $lulus ?></h2>
<p>Mahasiswa Lulus</p>
</div>

<div class="stat-icon">
<i class="bi bi-check-circle-fill"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="stat-card bg3">

<div class="d-flex justify-content-between align-items-center">

<div>
<h2><?= $pending ?></h2>
<p>Status Pending</p>
</div>

<div class="stat-icon">
<i class="bi bi-hourglass-split"></i>
</div>

</div>

</div>

</div>

<div class="col-md-3">

<div class="stat-card bg4">

<div class="d-flex justify-content-between align-items-center">

<div>
<h2><?= $aktif ?></h2>
<p>Mahasiswa Aktif</p>
</div>

<div class="stat-icon">
<i class="bi bi-award-fill"></i>
</div>

</div>

</div>

</div>

</div>

<!-- MENU -->
<div class="row g-4">

<!-- PENDAFTARAN -->
<div class="col-md-4">

<a href="pendaftaran.php" class="text-decoration-none">

<div class="card-box text-center">

<div class="menu-icon menu1">
<i class="bi bi-pencil-square"></i>
</div>

<h5 class="card-title">
Pendaftaran
</h5>

<p class="card-text">
Kelola data seluruh calon mahasiswa baru
</p>

</div>

</a>

</div>

<!-- VERIFIKASI -->
<div class="col-md-4">

<a href="verifikasi.php" class="text-decoration-none">

<div class="card-box text-center">

<div class="menu-icon menu2">
<i class="bi bi-patch-check-fill"></i>
</div>

<h5 class="card-title">
Verifikasi
</h5>

<p class="card-text">
Validasi data dan dokumen mahasiswa
</p>

</div>

</a>

</div>

<!-- PEMBAYARAN -->
<div class="col-md-4">

<a href="pembayaran.php" class="text-decoration-none">

<div class="card-box text-center">

<div class="menu-icon menu3">
<i class="bi bi-credit-card-fill"></i>
</div>

<h5 class="card-title">
Pembayaran
</h5>

<p class="card-text">
Konfirmasi pembayaran daftar ulang
</p>

</div>

</a>

</div>

<!-- PENGUMUMAN -->
<div class="col-md-4">

<a href="pengumuman.php" class="text-decoration-none">

<div class="card-box text-center">

<div class="menu-icon menu4">
<i class="bi bi-megaphone-fill"></i>
</div>

<h5 class="card-title">
Pengumuman
</h5>

<p class="card-text">
Kelola hasil seleksi dan informasi
</p>

</div>

</a>

</div>

<!-- OSPEK -->
<div class="col-md-4">

<a href="ospek.php" class="text-decoration-none">

<div class="card-box text-center">

<div class="menu-icon menu5">
<i class="bi bi-mortarboard-fill"></i>
</div>

<h5 class="card-title">
OSPEK
</h5>

<p class="card-text">
Aktivasi mahasiswa dan daftar ulang
</p>

</div>

</a>

</div>

</div>

</div>

<!-- FOOTER -->
<div class="footer">

    © 2026 PMB Universitas Nusantara • Admin Dashboard System

</div>

<!-- AUTO HIDE TOAST -->
<script>

setTimeout(() => {

    const toast = document.querySelector(".toast-custom");

    if(toast){

        toast.style.transition = "0.5s";
        toast.style.opacity = "0";
        toast.style.transform = "translateX(100%)";

        setTimeout(()=>{
            toast.remove();
        },500);

    }

},3000);

</script>

</body>
</html>