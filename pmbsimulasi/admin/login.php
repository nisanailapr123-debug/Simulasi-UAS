<?php
session_start();

if(isset($_SESSION['admin_id'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin PMB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#1e293b,#334155,#0f172a);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Poppins;
}

.card-login{
    width:400px;
    padding:30px;
    border-radius:20px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    color:white;
    box-shadow:0 10px 30px rgba(0,0,0,0.4);
}
</style>
</head>

<body>

<div class="card card-login">

<h3 class="text-center mb-3">⚙ Admin PMB</h3>

<form action="proses_login.php" method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" class="btn btn-light w-100">
Login Admin
</button>

</form>

</div>

</body>
</html>