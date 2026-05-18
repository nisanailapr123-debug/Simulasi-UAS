<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM pendaftar ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengumuman Kelulusan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#dbeafe,#ede9fe,#fbcfe8);
    font-family:Poppins;
}

.card-box{
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(12px);
    border-radius:20px;
    padding:20px;
}
</style>
</head>

<body>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">
    <h3>📢 Pengumuman Kelulusan</h3>
    <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
</div>

<div class="card card-box">

<table class="table table-bordered">

<thead class="table-dark">
<tr>
    <th>Nama</th>
    <th>Status Daftar</th>
    <th>Kelulusan</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $row['nama_lengkap']; ?></td>

    <td>
        <span class="badge bg-warning">
            <?= $row['status']; ?>
        </span>
    </td>

    <td>
        <?php if($row['status_kelulusan']=='lulus'){ ?>
            <span class="badge bg-success">LULUS</span>
        <?php } elseif($row['status_kelulusan']=='tidak'){ ?>
            <span class="badge bg-danger">TIDAK LULUS</span>
        <?php } else { ?>
            <span class="badge bg-secondary">PENDING</span>
        <?php } ?>
    </td>

    <td>

        <a href="proses_pengumuman.php?id=<?= $row['id']; ?>&status=lulus"
           class="btn btn-success btn-sm">✔ Lulus</a>

        <a href="proses_pengumuman.php?id=<?= $row['id']; ?>&status=tidak"
           class="btn btn-danger btn-sm">❌ Tidak</a>

    </td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>