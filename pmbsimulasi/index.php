<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>PMB Universitas Nusantara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#e0f2fe,#fce7f3,#dbeafe);
}

/* NAVBAR */
.navbar{
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(15px);
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    position: sticky;
    top:0;
    z-index:1000;
}

/* HERO */
.hero{
    padding:100px 20px;
    text-align:center;
}

.hero-box{
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(20px);
    padding:60px;
    border-radius:30px;
    max-width:900px;
    margin:auto;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

.hero h1{
    font-weight:800;
}

/* GLASS CARD */
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

/* SECTION */
.section{
    padding:80px 20px;
}

/* STAT */
.stat{
    text-align:center;
    padding:20px;
}

/* CTA */
.cta{
    background: linear-gradient(135deg,#6366f1,#ec4899);
    color:white;
    padding:60px;
    border-radius:25px;
    text-align:center;
}

/* FOOTER */
footer{
    background: rgba(255,255,255,0.7);
    padding:40px 20px;
    margin-top:60px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4">
<div class="container">

    <a class="navbar-brand fw-bold">🎓 PMB UNIVERSITAS NUSANTARA</a>

    <div class="ms-auto">
        <a href="alur_pendaftaran.php" class="btn btn-outline-dark btn-sm">Alur</a>
        <a href="karir.php" class="btn btn-outline-dark btn-sm">Karir</a>
        <a href="login.php" class="btn btn-dark btn-sm">Login</a>
    </div>

</div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="hero-box">

        <h1>Bangun Masa Depan Bersama Kami 🚀</h1>
        <p class="text-muted mt-3">
            Sistem Penerimaan Mahasiswa Baru modern, cepat, dan transparan berbasis web.
        </p>

        <div class="mt-4">
            <a href="register.php" class="btn btn-dark px-4">Daftar Sekarang</a>
            <a href="alur_pendaftaran.php" class="btn btn-outline-dark px-4">Lihat Alur</a>
        </div>

    </div>
</div>

<!-- STATISTIK -->
<div class="container section">
<div class="row text-center">

    <div class="col-md-4">
        <div class="glass stat">
            <h2>1200+</h2>
            <p>Mahasiswa Baru</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass stat">
            <h2>50+</h2>
            <p>Program Studi</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass stat">
            <h2>95%</h2>
            <p>Tingkat Kelulusan</p>
        </div>
    </div>

</div>
</div>

<!-- FITUR -->
<div class="container section">
<h3 class="text-center mb-4">✨ Kenapa Pilih Kami?</h3>

<div class="row g-4">

    <div class="col-md-4">
        <div class="glass p-4 text-center">
            <i class="fa fa-laptop fs-1 mb-2"></i>
            <h5>Sistem Digital</h5>
            <p class="text-muted">Semua proses online tanpa ribet</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4 text-center">
            <i class="fa fa-shield fs-1 mb-2"></i>
            <h5>Aman & Terverifikasi</h5>
            <p class="text-muted">Data mahasiswa terjamin</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4 text-center">
            <i class="fa fa-clock fs-1 mb-2"></i>
            <h5>Cepat & Efisien</h5>
            <p class="text-muted">Proses pendaftaran real-time</p>
        </div>
    </div>

</div>
</div>

<!-- CTA -->
<div class="container section">
<div class="cta">

    <h2>Siap Jadi Mahasiswa Kami?</h2>
    <p>Daftar sekarang dan mulai perjalanan akademikmu</p>

    <a href="register.php" class="btn btn-light px-4 mt-2">Mulai Daftar</a>

</div>
</div>

<!-- TESTIMONI -->
<div class="container section">
<h3 class="text-center mb-4">💬 Testimoni Alumni</h3>

<div class="row g-4">

    <div class="col-md-4">
        <div class="glass p-4">
            <p>"Sistem pendaftarannya mudah banget!"</p>
            <b>- Andi</b>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4">
            <p>"Kampusnya modern dan keren!"</p>
            <b>- Siti</b>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass p-4">
            <p>"Proses cepat dan transparan."</p>
            <b>- Budi</b>
        </div>
    </div>

</div>
</div>

<!-- FOOTER -->
<footer>
<div class="container">
<div class="row">

    <div class="col-md-4">
        <h5>Universitas Nusantara</h5>
        <p class="text-muted">Kampus modern berbasis teknologi digital.</p>
    </div>

    <div class="col-md-4">
        <h5>Menu</h5>
        <p>Alur Pendaftaran</p>
        <p>Karir</p>
        <p>Login</p>
    </div>

    <div class="col-md-4">
        <h5>Kontak</h5>
        <p>📍 Indonesia</p>
    </div>

</div>

<hr>

<p class="text-center text-muted">
    © 2026 PMB Universitas Nusantara
</p>

</div>
</footer>

</body>
</html>