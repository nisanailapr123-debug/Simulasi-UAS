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
<title>Pembayaran PMB</title>

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
    <h3>💳 Data Pembayaran</h3>
    <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
</div>

<div class="card card-box">

<table class="table table-bordered table-hover">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Status Daftar</th>
    <th>Bukti Bayar</th>
    <th>Status Bayar</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_lengkap']; ?></td>

    <td>
        <span class="badge bg-warning">
            <?= $row['status']; ?>
        </span>
    </td>

    <td>
        <?php if(!empty($row['file_bukti'])) { ?>
            <a href="../uploads/gambar/<?= $row['file_bukti']; ?>" target="_blank">
                Lihat Bukti
            </a>
        <?php } else { ?>
            <span class="text-danger">Belum Upload</span>
        <?php } ?>
    </td>

    <td>
        <?php if(!empty($row['status_bayar']) && $row['status_bayar']=='lunas'){ ?>
            <span class="badge bg-success">LUNAS</span>
        <?php } else { ?>
            <span class="badge bg-danger">BELUM</span>
        <?php } ?>
    </td>

    <td>

        <a href="proses_pembayaran.php?id=<?= $row['id']; ?>&status=lunas"
           class="btn btn-success btn-sm">
           ✔ Lunas
        </a>

        <a href="proses_pembayaran.php?id=<?= $row['id']; ?>&status=belum"
           class="btn btn-danger btn-sm">
           ❌ Belum
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