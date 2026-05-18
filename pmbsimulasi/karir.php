<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Karir Alumni - PMB Universitas Nusantara</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#e0f2fe,#fce7f3,#dbeafe);
    min-height: 100vh;
}

/* HEADER */
.header{
    text-align:center;
    padding:70px 20px 20px;
}

.header h1{
    font-weight:800;
    color:#0f172a;
}

/* CARD */
.card-glass{
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(12px);
    border: none;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition:0.3s;
    height: 100%;
}

.card-glass:hover{
    transform: translateY(-10px);
}

/* ICON */
.icon-box{
    font-size:40px;
    color:#4f46e5;
    margin-bottom:10px;
}

/* STATS */
.stat{
    text-align:center;
    padding:30px;
}

/* FOOTER */
footer{
    text-align:center;
    padding:20px;
    color:#64748b;
    margin-top:50px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <h1>💼 Karir Alumni</h1>
    <p class="text-muted">Lulusan kami bekerja di berbagai industri modern</p>
</div>

<!-- STATISTIK -->
<div class="container">
<div class="row text-center mb-5">

    <div class="col-md-4">
        <div class="card-glass stat">
            <h2>95%</h2>
            <p>Tingkat Penyerapan Kerja</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass stat">
            <h2>1200+</h2>
            <p>Alumni Aktif Bekerja</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass stat">
            <h2>50+</h2>
            <p>Perusahaan Mitra</p>
        </div>
    </div>

</div>

<!-- KARIR -->
<div class="row g-4 text-center">

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-laptop-code"></i></div>
            <h5>Software Engineer</h5>
            <p class="text-muted">Bekerja di perusahaan teknologi & startup</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-chart-line"></i></div>
            <h5>Data Analyst</h5>
            <p class="text-muted">Analisis data di perusahaan besar</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-shield-alt"></i></div>
            <h5>Cyber Security</h5>
            <p class="text-muted">Keamanan sistem digital modern</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-briefcase"></i></div>
            <h5>Entrepreneur</h5>
            <p class="text-muted">Membangun bisnis sendiri</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-bullhorn"></i></div>
            <h5>Digital Marketing</h5>
            <p class="text-muted">Strategi pemasaran online</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-glass">
            <div class="icon-box"><i class="fa fa-university"></i></div>
            <h5>PNS / ASN</h5>
            <p class="text-muted">Karir pemerintahan & institusi publik</p>
        </div>
    </div>

</div>

<!-- BUTTON BACK -->
<div class="text-center mt-5">
    <a href="index.php" class="btn btn-dark px-4 py-2 rounded-pill">
        ⬅ Kembali ke Beranda
    </a>
</div>

</div>

<!-- FOOTER -->
<footer>
    © 2026 PMB Universitas Nusantara • Alumni Career Center
</footer>

</body>
</html>