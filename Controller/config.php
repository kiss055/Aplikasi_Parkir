<<?php
date_default_timezone_set('Asia/Jakarta');

$conn = mysqli_connect("localhost","root","","aplikasi_parkir");

if(!$conn){
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
