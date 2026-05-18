<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "UPDATE pendaftar SET status_ospek='$status' WHERE id='$id'");

header("Location: ospek.php");
exit;
?>