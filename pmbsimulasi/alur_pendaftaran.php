<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Alur Pendaftaran PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#e0f2fe,#fce7f3,#dbeafe);
}

/* HEADER */
.navbar{
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(15px);
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* CARD */
.glass{
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border:none;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:0.3s;
}
.glass:hover{
    transform: translateY(-8px);
}

/* FOOTER */
footer{
    margin-top:60px;
    padding:20px;
    text-align:center;
    color:#64748b;
}
</style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg px-4">
<div class="container">

    <a class="navbar-brand fw-bold">🎓 PMB UNIVERSITAS NUSANTARA</a>

    <div>
        <a href="index.php" class="btn btn-outline-dark btn-sm">Home</a>
        <a href="login.php" class="btn btn-dark btn-sm">Login</a>
    </div>

</div>
</nav>

<!-- CONTENT -->
<div class="container py-5">

<h2 class="text-center fw-bold mb-4">📌 Alur Pendaftaran Mahasiswa Baru</h2>

<div class="row g-4 text-center">

    <div class="col-md-3">
        <div class="glass p-4">
            <i class="fa fa-user-plus fs-2 mb-2"></i>
            <h6>Daftar Akun</h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass p-4">
            <i class="fa fa-file fs-2 mb-2"></i>
            <h6>Isi Data</h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass p-4">
            <i class="fa fa-upload fs-2 mb-2"></i>
            <h6>Upload Berkas</h6>
        </div>
    </div>

    <div class="col-md-3">
        <div class="glass p-4">
            <i class="fa fa-check fs-2 mb-2"></i>
            <h6>Verifikasi</h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4">
            <i class="fa fa-clipboard-check fs-2 mb-2"></i>
            <h6>Ujian</h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4">
            <i class="fa fa-money-bill fs-2 mb-2"></i>
            <h6>Pembayaran</h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4">
            <i class="fa fa-graduation-cap fs-2 mb-2"></i>
            <h6>OSPEK</h6>
        </div>
    </div>

</div>

<div class="text-center mt-5">
    <a href="index.php" class="btn btn-dark px-4 rounded-pill">
        ⬅ Kembali ke Beranda
    </a>
</div>

</div>

<!-- FOOTER -->
<footer>
    © 2026 PMB Universitas Nusantara • Sistem Informasi Kampus
</footer>

</body>
</html>