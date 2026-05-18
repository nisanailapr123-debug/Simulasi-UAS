<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

/* update status */
mysqli_query($conn, "UPDATE pendaftar SET status='$status' WHERE id='$id'");

header("Location: pendaftaran.php");
exit;
?>