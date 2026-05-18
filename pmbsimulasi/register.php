<?php
include "../pmbsimulasi/admin/koneksi.php";

$message = "";

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "mahasiswa";

    // cek email sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($cek) > 0){
        $message = "Email sudah terdaftar!";
    } else {

        $query = mysqli_query($conn, 
        "INSERT INTO users (nama, email, password, role)
        VALUES ('$nama','$email','$password','$role')");

        if($query){
            $message = "Registrasi berhasil! Silakan login.";
        } else {
            $message = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#dbeafe,#fce7f3,#e0f2fe);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:Segoe UI;
}

.card-register{
    width:420px;
    padding:30px;
    border-radius:20px;
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(15px);
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.title{
    font-weight:700;
    text-align:center;
}
</style>
</head>

<body>

<div class="card-register">

    <h3 class="title">📝 Register Mahasiswa</h3>
    <p class="text-center text-muted">Buat akun PMB Online</p>

    <?php if($message != "") { ?>
        <div class="alert alert-info text-center">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="register" class="btn btn-dark w-100">
            Daftar
        </button>

    </form>

    <p class="text-center mt-3">
        Sudah punya akun? <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>