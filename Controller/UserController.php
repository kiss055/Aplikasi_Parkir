<?php
session_start();
// Memulai session agar data admin yang sedang login bisa digunakan
require_once 'config.php';

// Pastikan koneksi tersedia
if (!isset($conn)) {
    die("Koneksi database tidak ditemukan.");
}

/**
 * =====================
 * LOG AKTIVITAS
 * =====================
 */
function logAktivitas($conn, $id_user, $aktivitas) {
    // CEK APAKAH USER MASIH ADA
    $cek = mysqli_query($conn, "SELECT id_user FROM tb_user WHERE id_user='$id_user'");
    if (mysqli_num_rows($cek) == 0) {
        return; // STOP jika user tidak ditemukan
    }

    $waktu = date('Y-m-d H:i:s');
    $aktivitasSafe = mysqli_real_escape_string($conn, $aktivitas);
    
    // Perbaikan: Menambahkan koma dan petik yang benar pada VALUES
    mysqli_query($conn, "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) 
                         VALUES ('$id_user', '$aktivitasSafe', '$waktu')");
}

/**
 * =====================
 * TAMBAH USER
 * =====================
 */
if (isset($_POST['simpan_user'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // Gunakan nama kolom agar lebih aman
    $query = "INSERT INTO tb_user (nama_lengkap, username, password, role, status_aktif) 
              VALUES ('$nama', '$username', '$password', '$role', 1)";
    
    if (mysqli_query($conn, $query)) {
        logAktivitas($conn, $_SESSION['id_user'], 'Tambah User: ' . $username);
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'User berhasil ditambahkan'
        ];
    } else {
        $_SESSION['alert'] = ['icon' => 'error', 'title' => 'Gagal', 'text' => 'Gagal menambah user'];
    }

    header("Location: ../Views/admin/admin.php?page=user");
    exit;
}

/**
 * =====================
 * HAPUS USER
 * =====================
 */
if (isset($_GET['hapus'])) {
    $idUserHapus = mysqli_real_escape_string($conn, $_GET['hapus']);
    $idAdmin     = $_SESSION['id_user'];

    // Ambil info user sebelum dihapus untuk log
    $dataUser = mysqli_query($conn, "SELECT username FROM tb_user WHERE id_user='$idUserHapus'");
    $u = mysqli_fetch_assoc($dataUser);
    $usernameHapus = $u['username'] ?? $idUserHapus;

    // 1. LOG AKTIVITAS
    logAktivitas($conn, $idAdmin, 'Hapus User: ' . $usernameHapus);

    // 2. HAPUS USER
    mysqli_query($conn, "DELETE FROM tb_user WHERE id_user='$idUserHapus'");

    $_SESSION['alert'] = [
        'icon'  => 'success',
        'title' => 'Berhasil',
        'text'  => 'User berhasil dihapus'
    ];

    header("Location: ../Views/admin/admin.php?page=user");
    exit;
}

/**
 * =====================
 * UPDATE USER
 * =====================
 */
if (isset($_POST['update_user'])) {
    $id       = mysqli_real_escape_string($conn, $_POST['id_user']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    if (!empty($_POST['password'])) {
        // Jika password diisi (ingin ganti password)
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET 
                  nama_lengkap='$nama', 
                  username='$username', 
                  password='$password', 
                  role='$role' 
                  WHERE id_user='$id'";
    } else {
        // Jika password kosong (tidak ingin ganti password)
        $query = "UPDATE tb_user SET 
                  nama_lengkap='$nama', 
                  username='$username', 
                  role='$role' 
                  WHERE id_user='$id'";
    }

    if (mysqli_query($conn, $query)) {
        logAktivitas($conn, $_SESSION['id_user'], 'Edit User: ' . $username);
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Berhasil',
            'text'  => 'User berhasil diperbarui'
        ];
    }

    header("Location: ../Views/admin/admin.php?page=user");
    exit;
}
