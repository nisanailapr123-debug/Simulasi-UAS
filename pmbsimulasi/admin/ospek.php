<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM pendaftar WHERE status_kelulusan='lulus'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Verifikasi OSPEK</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#dbeafe,#ede9fe,#fbcfe8);
    font-family: Poppins;
}

.header-box{
    background: rgba(255,255,255,0.4);
    backdrop-filter: blur(12px);
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.table-box{
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.badge-custom{
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 12px;
}

.btn-custom{
    border-radius: 10px;
}
</style>

</head>

<body>

<div class="container mt-4">

<!-- HEADER -->
<div class="header-box d-flex justify-content-between align-items-center mb-3">

<h3 class="m-0">🎓 Verifikasi OSPEK</h3>

<a href="dashboard.php" class="btn btn-secondary btn-sm">
⬅ Kembali
</a>

</div>

<!-- TABLE -->
<div class="table-box">

<table class="table table-hover align-middle text-center">

<thead class="table-dark">
<tr>
    <th>Nama Mahasiswa</th>
    <th>Bukti Daftar Ulang</th>
    <th>Status OSPEK</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($data)) { ?>

<tr>

    <td class="fw-semibold">
        👤 <?= $row['nama_lengkap']; ?>
    </td>

    <td>
        <?php if($row['file_ospek']) { ?>
            <a href="../uploads/gambar/<?= $row['file_ospek']; ?>" 
               class="btn btn-info btn-sm btn-custom" target="_blank">
               📄 Lihat File
            </a>
        <?php } else { ?>
            <span class="badge bg-danger badge-custom">
                Belum Upload
            </span>
        <?php } ?>
    </td>

    <td>
        <?php if($row['status_ospek']=='aktif'){ ?>
            <span class="badge bg-success badge-custom">
                ✔ AKTIF
            </span>
        <?php } else { ?>
            <span class="badge bg-warning text-dark badge-custom">
                ⏳ PENDING
            </span>
        <?php } ?>
    </td>

    <td>

        <a href="proses_ospek.php?id=<?= $row['id']; ?>&status=aktif"
           class="btn btn-success btn-sm btn-custom">
           ✔ Aktifkan
        </a>

    </td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>