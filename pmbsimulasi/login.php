<?php
session_start();
include "../pmbsimulasi/admin/koneksi.php";

$error = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        if(password_verify($password, $data['password'])){

            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            if($data['role'] == 'admin'){
                header("Location: admin/dashboard.php");
            } else {
                header("Location: mahasiswa/dashboard.php");
            }

        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family: Poppins;
    background: linear-gradient(-45deg,#dbeafe,#ede9fe,#fbcfe8,#c7d2fe);
    background-size: 400% 400%;
    animation: bg 10s ease infinite;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

@keyframes bg{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* container */
.login-box{
    width: 900px;
    display: flex;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

/* kiri */
.left{
    flex:1;
    background: linear-gradient(135deg,#6366f1,#ec4899);
    color:white;
    padding:40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.left h1{
    font-size:32px;
    font-weight:800;
}

.left p{
    opacity:0.9;
}

/* kanan */
.right{
    flex:1;
    padding:40px;
    background: rgba(255,255,255,0.4);
    backdrop-filter: blur(10px);
}

/* input */
.form-control{
    border-radius:12px;
    padding:12px;
}

.btn-login{
    border-radius:12px;
    padding:12px;
    background: linear-gradient(135deg,#6366f1,#ec4899);
    border:none;
    color:white;
    font-weight:600;
    transition:0.3s;
}

.btn-login:hover{
    transform: scale(1.03);
}

/* error */
.alert{
    border-radius:12px;
}

/* responsive */
@media(max-width:768px){
    .login-box{
        flex-direction:column;
        width:95%;
    }
}
</style>
</head>

<body>

<div class="login-box">

    <!-- LEFT -->
    <div class="left">
        <h1>🎓 PMB ONLINE</h1>
        <p>Sistem Penerimaan Mahasiswa Baru</p>
        <p class="mt-3">
            ✔ Pendaftaran Online<br>
            ✔ Seleksi & Verifikasi<br>
            ✔ Pengumuman Hasil<br>
            ✔ Daftar Ulang & OSPEK
        </p>
    </div>

    <!-- RIGHT -->
    <div class="right">

        <h3 class="mb-3 fw-bold">Login Account</h3>
        <p class="text-muted">Masuk ke sistem PMB</p>

        <?php if($error != "") { ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" name="login" class="btn btn-login w-100">
                Login
            </button>

        </form>

        <p class="text-center mt-3 text-muted">
            Belum punya akun? <a href="register.php">Daftar</a>
        </p>

    </div>

</div>

</body>
</html>