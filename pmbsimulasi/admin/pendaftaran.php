<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

/* ambil semua data pendaftar */
$data = mysqli_query($conn, "SELECT * FROM pendaftar ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pendaftar</title>

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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>📝 Data Pendaftar</h3>
    <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
</div>

<div class="card card-box">

<table class="table table-bordered table-hover">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Sekolah</th>
    <th>Jurusan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama_lengkap']; ?></td>
    <td><?= $row['alamat']; ?></td>
    <td><?= $row['asal_sekolah']; ?></td>
    <td><?= $row['jurusan_pilihan']; ?></td>

    <td>
        <?php if($row['status']=='lulus'){ ?>
            <span class="badge bg-success">LULUS</span>
        <?php } elseif($row['status']=='ditolak'){ ?>
            <span class="badge bg-danger">DITOLAK</span>
        <?php } else { ?>
            <span class="badge bg-warning">PENDING</span>
        <?php } ?>
    </td>

    <td>

        <!-- ✔ LULUS -->
        <a href="verifikasi.php?id=<?= $row['id']; ?>&status=lulus"
           class="btn btn-success btn-sm">
           ✔ Lulus
        </a>

        <!-- ❌ TOLAK -->
        <a href="verifikasi.php?id=<?= $row['id']; ?>&status=ditolak"
           class="btn btn-danger btn-sm">
           ❌ Tolak
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