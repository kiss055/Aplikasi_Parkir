<?php
require_once 'config.php';
require_once '../Model/PetugasModel.php';

session_start();
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../Views/auth/login.php");
    exit;
}

$model = new PetugasModel($conn);

// PROSES MASUK
if (isset($_POST['simpan_masuk'])) {
    $plat = strtoupper(mysqli_real_escape_string($conn, $_POST['plat_nomor']));
    $id_tarif = mysqli_real_escape_string($conn, $_POST['id_tarif']);
    $id_area = mysqli_real_escape_string($conn, $_POST['id_area']);
    $id_user = $_SESSION['id_user'];
    $waktu_masuk = date('Y-m-d H:i:s');

    $result = $model->simpanMasuk($plat, $id_tarif, $id_area, $id_user, $waktu_masuk);

    if ($result) {
        header("Location: ../Views/petugas/petugas.php?page=struk_masuk&id=$result&msg=checkin_success");
    } else {
        header("Location: ../Views/petugas/petugas.php?page=transaksi_masuk&msg=error");
    }
    exit;
}

// PROSES KELUAR
if (isset($_POST['proses_keluar'])) {
    $id_parkir = mysqli_real_escape_string($conn, $_POST['id_parkir']);
    $waktu_keluar = date('Y-m-d H:i:s');

    $result = $model->prosesKeluar($id_parkir, $waktu_keluar);

    if ($result) {
        header("Location: ../Views/petugas/petugas.php?page=struk_keluar&id=$id_parkir&msg=checkout_success");
    } else {
        header("Location: ../Views/petugas/petugas.php?page=transaksi_keluar&msg=error");
    }
    exit;
}
