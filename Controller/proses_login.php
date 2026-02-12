<?php
session_start();
include 'config.php';

function logAktivitas($conn, $id_user, $aktivitas) {
    $waktu = date('Y-m-d H:i:s');
    $aktivitasSafe = mysqli_real_escape_string($conn, $aktivitas);
    mysqli_query($conn, "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) 
                         VALUES ('$id_user', '$aktivitasSafe', '$waktu')");
}

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cari user hanya berdasarkan username
    $q = mysqli_query($conn,"SELECT * FROM tb_user WHERE username='$username' AND status_aktif=1 LIMIT 1");
    $data = mysqli_fetch_assoc($q);

    // Cek apakah user ada dan password benar
    if($data && password_verify($password, $data['password'])){
        
        // SET SESSION DARI DATA DATABASE
        $_SESSION['login']   = true;
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['role']    = $data['role']; // Role otomatis dari DB
        $_SESSION['nama']    = $data['nama_lengkap'];

        // Catat Log
        logAktivitas($conn, $data['id_user'], "Login ke sistem sebagai " . $data['role']);

        $_SESSION['alert'] = [
            'icon' => 'success', 
            'title' => 'Login Berhasil', 
            'text' => 'Selamat datang kembali, ' . $data['nama_lengkap']
        ];

        // REDIRECT OTOMATIS BERDASARKAN ROLE
        $role = $data['role'];
        if($role == 'admin'){
            header("Location: ../Views/admin/admin.php");
        } elseif($role == 'petugas'){
            header("Location: ../Views/petugas/petugas.php");
        } elseif($role == 'owner'){
            header("Location: ../Views/owner/owner.php");
        } else {
            // Jika ada role lain yang belum terdaftar
            header("Location: ../Views/auth/login.php");
        }
        exit;

    } else {
        // Gagal login
        $_SESSION['alert'] = [
            'icon' => 'error', 
            'title' => 'Akses Ditolak', 
            'text' => 'Username atau password tidak ditemukan'
        ];
        header("Location: ../Views/auth/login.php");
        exit;
    }
}
