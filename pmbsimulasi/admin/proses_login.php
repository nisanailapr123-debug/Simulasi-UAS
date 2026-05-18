<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

if($user){

    if(password_verify($password, $user['password'])){

        // CEK ROLE HARUS ADMIN
        if($user['role'] != 'admin'){
            echo "<script>alert('Anda bukan admin!'); window.location='login.php';</script>";
            exit;
        }

        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_nama'] = $user['nama'];

        header("Location: dashboard.php");
        exit;

    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }

} else {
    echo "<script>alert('Email tidak ditemukan!'); window.location='login.php';</script>";
}
?>