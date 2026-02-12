<?php
require_once 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PROTEKSI AKSES ADMIN //
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Views/auth/login.php");
    exit;
}

/**
 * FUNGSI LOG AKTIVITAS
 */
function logAktivitas($conn, $id_user, $aktivitas) {
    $cek = mysqli_query($conn, "SELECT id_user FROM tb_user WHERE id_user='$id_user'");
    if (mysqli_num_rows($cek) == 0) return;

    $waktu = date('Y-m-d H:i:s');
    $aktivitasSafe = mysqli_real_escape_string($conn, $aktivitas);
    
    $query = "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) 
              VALUES ('$id_user', '$aktivitasSafe', '$waktu')";
    
    mysqli_query($conn, $query);
}

/* ==========================================
   BAGIAN: TARIF PARKIR
   ========================================== */

if (isset($_POST['tambah_tarif'])) {
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis_kendaraan']);
    $tarif = mysqli_real_escape_string($conn, $_POST['tarif_per_jam']);

    mysqli_query($conn, "INSERT INTO tb_tarif (jenis_kendaraan, tarif_per_jam) VALUES ('$jenis','$tarif')");
    logAktivitas($conn, $_SESSION['id_user'], "Tambah Tarif: $jenis - Rp $tarif");

    $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Tarif ditambahkan'];
    header("Location: ../Views/admin/admin.php?page=parkir&tab=tarif");
    exit;
}

if (isset($_POST['update_tarif'])) {
    $id    = mysqli_real_escape_string($conn, $_POST['id_tarif']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis_kendaraan']);
    $tarif = mysqli_real_escape_string($conn, $_POST['tarif_per_jam']);

    mysqli_query($conn, "UPDATE tb_tarif SET jenis_kendaraan='$jenis', tarif_per_jam='$tarif' WHERE id_tarif='$id'");
    logAktivitas($conn, $_SESSION['id_user'], "Update Tarif: $jenis");

    $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Tarif diperbarui'];
    header("Location: ../Views/admin/admin.php?page=parkir&tab=tarif");
    exit;
}

/* ==========================================
   BAGIAN: AREA PARKIR
   ========================================== */

if (isset($_POST['tambah_area'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_area']);
    $kap  = mysqli_real_escape_string($conn, $_POST['kapasitas']);

    mysqli_query($conn, "INSERT INTO tb_area_parkir (nama_area, kapasitas, terisi) VALUES ('$nama','$kap', 0)");
    logAktivitas($conn, $_SESSION['id_user'], "Tambah Area: $nama (Kapasitas: $kap)");

    $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Area ditambahkan'];
    header("Location: ../Views/admin/admin.php?page=parkir&tab=area");
    exit;
}

if (isset($_POST['update_area'])) {
    $id   = mysqli_real_escape_string($conn, $_POST['id_area']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_area']);
    $kap  = mysqli_real_escape_string($conn, $_POST['kapasitas']);

    $q = mysqli_query($conn, "UPDATE tb_area_parkir SET nama_area='$nama', kapasitas='$kap' WHERE id_area='$id'");
    
    if($q) {
        logAktivitas($conn, $_SESSION['id_user'], "Update Area: $nama (Kapasitas: $kap)");
        $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Area diperbarui'];
    }
    header("Location: ../Views/admin/admin.php?page=parkir&tab=area");
    exit;
}

/* ==========================================
   BAGIAN: DATA KENDARAAN (MEMBER)
   ========================================== */

if (isset($_POST['tambah_kendaraan'])) {
    $plat    = mysqli_real_escape_string($conn, $_POST['plat_nomor']);
    $jenis   = mysqli_real_escape_string($conn, $_POST['jenis_kendaraan']);
    $warna   = mysqli_real_escape_string($conn, $_POST['warna']);
    $pemilik = mysqli_real_escape_string($conn, $_POST['pemilik']);

    $query = "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, warna, pemilik) 
              VALUES ('$plat', '$jenis', '$warna', '$pemilik')";

    if (mysqli_query($conn, $query)) {
        logAktivitas($conn, $_SESSION['id_user'], "Tambah Kendaraan: $plat");
        $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Kendaraan ditambahkan'];
    }
    header("Location: ../Views/admin/admin.php?page=parkir&tab=kendaraan");
    exit;
}

if (isset($_POST['update_kendaraan'])) {
    $id      = mysqli_real_escape_string($conn, $_POST['id_kendaraan']);
    $plat    = mysqli_real_escape_string($conn, $_POST['plat_nomor']);
    $jenis   = mysqli_real_escape_string($conn, $_POST['jenis_kendaraan']);
    $warna   = mysqli_real_escape_string($conn, $_POST['warna']);
    $pemilik = mysqli_real_escape_string($conn, $_POST['pemilik']);

    mysqli_query($conn, "UPDATE tb_kendaraan SET plat_nomor='$plat', jenis_kendaraan='$jenis', warna='$warna', pemilik='$pemilik' WHERE id_kendaraan='$id'");
    logAktivitas($conn, $_SESSION['id_user'], "Update Kendaraan: $plat");

    $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Kendaraan diperbarui'];
    header("Location: ../Views/admin/admin.php?page=parkir&tab=kendaraan");
    exit;
}

/* ==========================================
   BAGIAN: HAPUS DATA (DENGAN PENANGANAN FOREIGN KEY)
   ========================================== */
if (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id   = (int)$_GET['id'];
    $tipe = $_GET['hapus'];
    $idAdmin = $_SESSION['id_user'];

    // Mulai penghapusan berdasarkan tipe
    if ($tipe == 'tarif') {
        // Hapus transaksi yang pakai tarif ini dulu agar tidak foreign key error
        mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_tarif = $id");
        mysqli_query($conn, "DELETE FROM tb_tarif WHERE id_tarif = $id");
        
    } elseif ($tipe == 'area') {
        // Hapus transaksi yang pakai area ini dulu
        mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_area = $id");
        mysqli_query($conn, "DELETE FROM tb_area_parkir WHERE id_area = $id");
        
    } elseif ($tipe == 'kendaraan') {
        // Hapus riwayat transaksi kendaraan ini dulu (PENTING!)
        mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_kendaraan = $id");
        // Baru hapus kendaraannya
        mysqli_query($conn, "DELETE FROM tb_kendaraan WHERE id_kendaraan = $id");
    }

    logAktivitas($conn, $idAdmin, "Hapus $tipe ID: $id");
    $_SESSION['alert'] = ['icon' => 'success', 'title' => 'Dihapus', 'text' => 'Data dan riwayat terkait berhasil dihapus'];
    header("Location: ../Views/admin/admin.php?page=parkir&tab=$tipe");
    exit;
}
