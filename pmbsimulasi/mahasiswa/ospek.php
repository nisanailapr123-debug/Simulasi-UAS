<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];

$data = mysqli_query($conn, "SELECT * FROM pendaftar WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($data);

$message = "";

// proses daftar ulang
if(isset($_POST['daftar_ulang'])){

    if($row['status'] != 'lulus'){
        $message = "Anda belum lulus seleksi!";
    } else {

        // upload bukti pembayaran
        $bukti = $_FILES['bukti']['name'];
        $tmp = $_FILES['bukti']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/gambar/".$bukti);

        // update status
        $update = mysqli_query($conn,
        "UPDATE pendaftar SET 
            status='aktif',
            file_ospek='$bukti',
            status_ospek='pending'
        WHERE user_id='$user_id'");

        if($update){
            $message = "Daftar ulang berhasil! Menunggu verifikasi admin.";
        } else {
            $message = "Gagal daftar ulang!";
        }
    }
}

$status = $row['status'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Daftar Ulang / OSPEK</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
*{
    font-family:'Poppins', sans-serif;
}

body{
    background: linear-gradient(135deg,#dbeafe,#ede9fe,#fbcfe8);
    min-height:100vh;
}

/* HEADER */
.navbar-custom{
    background:rgba(255,255,255,0.25);
    backdrop-filter:blur(15px);
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

/* CARD */
.card-box{
    background:rgba(255,255,255,0.35);
    backdrop-filter:blur(18px);
    border:none;
    border-radius:30px;
    padding:35px;
    box-shadow:0 12px 35px rgba(0,0,0,0.12);
    transition:0.3s;
}

.card-box:hover{
    transform:translateY(-5px);
}

/* TITLE */
.title{
    font-weight:800;
    color:#4c1d95;
}

/* BUTTON */
.btn-modern{
    border-radius:14px;
    padding:12px;
    font-weight:600;
    transition:0.3s;
}

.btn-modern:hover{
    transform:scale(1.02);
}

/* INPUT */
.form-control{
    border-radius:15px;
    padding:12px;
    border:none;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

/* INFO BOX */
.info-box{
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
    color:white;
    border-radius:20px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 10px 25px rgba(99,102,241,0.3);
}

/* STATUS */
.status-box{
    background:rgba(255,255,255,0.5);
    border-radius:20px;
    padding:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* FOOTER */
.footer{
    margin-top:60px;
    background:rgba(255,255,255,0.2);
    backdrop-filter:blur(10px);
    padding:20px;
    text-align:center;
    color:#475569;
}
</style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-custom">
<div class="container">

    <a class="navbar-brand fw-bold">
        🎓 PMB Universitas Nusantara
    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="fw-semibold">
            👋 <?= $_SESSION['nama']; ?>
        </span>

        <a href="dashboard.php" class="btn btn-outline-dark btn-sm">
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

<!-- TITLE -->
<div class="mb-4 text-center">

    <h2 class="title">
        🎓 Daftar Ulang & OSPEK
    </h2>

    <p class="text-muted">
        Lengkapi proses daftar ulang untuk menjadi mahasiswa aktif
    </p>

</div>

<!-- MESSAGE -->
<?php if($message != "") { ?>

<div class="alert alert-info alert-dismissible fade show shadow-sm">
    <?= $message; ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<?php } ?>

<!-- INFO -->
<div class="info-box">

    <h5 class="fw-bold">
        📢 Informasi Daftar Ulang
    </h5>

    <p class="mb-0">
        Upload bukti pembayaran daftar ulang untuk mengikuti kegiatan OSPEK dan aktivasi mahasiswa baru.
    </p>

</div>

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card-box">

<!-- STATUS -->
<div class="status-box mb-4">

    <h5 class="fw-bold mb-3">
        📋 Data Mahasiswa
    </h5>

    <div class="row">

        <div class="col-md-6 mb-3">
            <small class="text-muted">Nama Lengkap</small>
            <h6><?= $row['nama_lengkap'] ?? '-' ?></h6>
        </div>

        <div class="col-md-6 mb-3">
            <small class="text-muted">Status PMB</small>
            <br>

            <?php
            if($status == 'lulus'){
            ?>

                <span class="badge bg-success p-2">
                    LULUS
                </span>

            <?php
            } elseif($status == 'aktif'){
            ?>

                <span class="badge bg-primary p-2">
                    MAHASISWA AKTIF
                </span>

            <?php
            } else {
            ?>

                <span class="badge bg-warning text-dark p-2">
                    PENDING
                </span>

            <?php
            }
            ?>

        </div>

    </div>

</div>

<?php if($status == 'lulus'){ ?>

<!-- FORM -->
<form method="POST" enctype="multipart/form-data">

    <div class="mb-4">

        <label class="fw-semibold mb-2">
            Upload Bukti Pembayaran
        </label>

        <input type="file"
               name="bukti"
               class="form-control"
               required>

        <small class="text-muted">
            Format: JPG / PNG / PDF
        </small>

    </div>

    <button type="submit"
            name="daftar_ulang"
            class="btn btn-dark btn-modern w-100">

        <i class="bi bi-check-circle-fill"></i>
        Konfirmasi Daftar Ulang

    </button>

</form>

<?php } elseif($status == 'aktif'){ ?>

<div class="alert alert-success text-center shadow-sm">

    <h5>
        🎉 Selamat!
    </h5>

    <p class="mb-0">
        Anda sudah resmi menjadi mahasiswa aktif.
    </p>

</div>

<?php } else { ?>

<div class="alert alert-warning shadow-sm">

    ❌ Anda hanya bisa daftar ulang jika status sudah
    <b>LULUS</b>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

<!-- FOOTER -->
<div class="footer">

    © 2026 PMB Universitas Nusantara • Sistem Daftar Ulang Mahasiswa

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>