<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../Model/OwnerModel.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'owner') {
    header("Location: ../Views/auth/login.php");
    exit;
}

// Filter tanggal
$tgl_mulai = $_POST['tgl_mulai'] ?? date('Y-m-01');
$tgl_selesai = $_POST['tgl_selesai'] ?? date('Y-m-d');

// Panggil Model
$model = new OwnerModel($conn);
$result = $model->getRekapTransaksi($tgl_mulai, $tgl_selesai);

// Kirim data ke View
$data = $result['data'];
$total_pendapatan = $result['total_pendapatan'];
$jumlah_transaksi = $result['jumlah_transaksi'];

// Load View
require_once __DIR__ . '/../Views/owner/Owner.php';