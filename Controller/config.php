<?php
//konfigurasi koneksi ke database,digunakan oleh seluruh file di dalam aplikasi

date_default_timezone_set('Asia/Jakarta');
//berfungsi menyamakan jam sistem PHP dengan jam lokal Indonesia, supaya semua proses waktu di aplikasi akurat dan konsisten.

$conn = mysqli_connect("127.0.0.1","root","root","aplikasi_parkir");
// koneksi ke database

if(!$conn){
    die("Koneksi database gagal!");
    //mengecek apakah koneksi berhasil
}
?>