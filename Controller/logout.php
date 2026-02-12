<?php
session_start();
//memulai session agar data user yang sedang login bisa di akses

require_once __DIR__ . '/config.php';
//menghubungkan file ini dengan config.php untuk mendapatkan koneksi database ($conn)


function logAktivitas($conn, $id_user, $aktivitas)
//fungsi untuk mencatat aktivitas user ke dalam database 
{
  
    $waktu = date('Y-m-d H:i:s');
    //menyimpan waktu saat aktivitas dilakukan yang terkait dengan
    
    mysqli_query($conn, "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) 
     VALUES ('$id_user', '$aktivitas', '$waktu')");
     //menyimpan data aktivitas logout ke tabel log aktivitas 
}

if(isset($_SESSION['id_user'])){
//mengecek apakah session id_user masih ada (artinya user sedang login)

    logAktivitas($conn, $_SESSION['id_user'], "Logout dari sistem");
  //mencatat aktivitas logout user ke dalam database sebelum session dihapus
}

session_unset();
//digunakan untuk mengosongkan seluruh variabel session 

session_destroy();
//digunakan untuk menghentikan session agar user benar² keluar dari sistem 

header("Location: ../Views/auth/login.php");
//mengarahkan kembali user ke halaman login setelah logut

exit;
//berfungsi untuk menghentikan seluruh proses program PHP pada saat itu juga