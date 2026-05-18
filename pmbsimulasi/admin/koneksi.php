<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pmb_web"
);

if(!$conn){
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

?>