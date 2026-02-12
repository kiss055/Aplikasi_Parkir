<?php
require_once __DIR__ . '/../../Controller/config.php';
require_once __DIR__ . '/../../Model/PetugasModel.php';

session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../auth/login.php");
    exit;
}

// Inisialisasi Model
$model = new PetugasModel($conn);
$page = $_GET['page'] ?? 'transaksi_masuk';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Operational | Smart Parking</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-width: 260px;
        }

        body { 
            background: #f8fafc; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-gradient);
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header { padding: 30px 25px 15px; text-align: center; }
        .logo-wrapper {
            width: 55px; height: 55px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-menu { padding: 10px 18px; flex-grow: 1; }
        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            display: flex; align-items: center;
            padding: 13px 18px;
            text-decoration: none;
            border-radius: 14px;
            margin-bottom: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .sidebar a i { width: 28px; font-size: 18px; margin-right: 10px; text-align: center; }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: #ffffff;
            color: #667eea;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            font-weight: 700;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 35px;
            min-height: 100vh;
        }

        .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

        .btn-premium {
            background: var(--primary-gradient);
            border: none; color: white;
            font-weight: 700; border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .struk-card {
            border: 2px dashed #cbd5e1;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            max-width: 400px;
            margin: auto;
        }

        @media (max-width: 991px) {
            .sidebar { left: 0; width: 220px; }
            .main-content { margin-left: 220px; padding: 15px; }
        }

        @media print {
            .no-print { display: none !important; }
            .main-content { margin-left: 0; padding: 0; }
            .struk-card { border: none; box-shadow: none; padding: 20px; }
            body { background: white; }
        }
    </style>
</head>
<body>

<div class="sidebar no-print">
    <div class="sidebar-header">
        <div class="logo-wrapper">
            <i class="fas fa-parking text-white fs-2"></i>
        </div>
        <h5 class="fw-bold text-white mb-0">GATE SYSTEM</h5>
        <small class="text-white-50">Petugas Gate</small>
    </div>

    <div class="sidebar-menu mt-3">
        <a href="?page=transaksi_masuk" class="<?= $page=='transaksi_masuk' || $page=='struk_masuk' ?'active':'' ?>">
            <i class="fas fa-sign-in-alt"></i> Check-In
        </a>
        <a href="?page=transaksi_keluar" class="<?= $page=='transaksi_keluar' || $page=='struk_keluar' ?'active':'' ?>">
            <i class="fas fa-sign-out-alt"></i> Check-Out
        </a>
        <div class="mt-4 pt-4 border-top border-white border-opacity-10">
            <a href="../../Controller/logout.php" class="text-warning logout-link">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h3 class="fw-bold text-dark mb-1">Operational Dashboard</h3>
            <p class="text-muted small mb-0">Petugas Aktif: <b><?= $_SESSION['nama'] ?></b></p>
        </div>
        <div class="bg-white px-3 py-2 rounded-3 shadow-sm small fw-bold border">
            <i class="far fa-calendar-alt text-primary me-2"></i> <?= date('d F Y') ?>
        </div>
    </div>

    <?php if($page == 'transaksi_masuk'): ?>
        <div class="row justify-content-center animate__animated animate__fadeIn">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-3">
                            <i class="fas fa-car-side fs-2 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Kendaraan Masuk</h4>
                    </div>
                    <form method="POST" action="../../Controller/PetugasController.php">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Nomor Plat</label>
                            <input type="text" name="plat_nomor" class="form-control form-control-lg bg-light border-0 fw-bold" placeholder="B 1234 ABC" required style="text-transform: uppercase;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Jenis Kendaraan</label>
                            <select name="id_tarif" class="form-select form-select-lg bg-light border-0" required>
                                <option value="">-- Pilih Jenis --</option>
                                <?php 
                                $tarifList = $model->getTarifList();
                                while($t = mysqli_fetch_assoc($tarifList)): ?>
                                    <option value="<?= $t['id_tarif'] ?>"><?= ucfirst($t['jenis_kendaraan']) ?> (Rp <?= number_format($t['tarif_per_jam']) ?>/jam)</option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">Area Parkir</label>
                            <select name="id_area" class="form-select form-select-lg bg-light border-0" required>
                                <option value="">-- Pilih Area --</option>
                                <?php 
                                $areaList = $model->getAvailableAreas();
                                while($a = mysqli_fetch_assoc($areaList)): ?>
                                    <option value="<?= $a['id_area'] ?>"><?= $a['nama_area'] ?> (Tersedia: <?= $a['kapasitas'] - $a['terisi'] ?> Slot)</option>      
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button name="simpan_masuk" class="btn btn-premium w-100 py-3 fs-5">
                            <i class="fas fa-print me-2"></i> Cetak Tiket Masuk
                        </button>
                    </form>
                </div>
            </div>
        </div>

    <?php elseif($page == 'transaksi_keluar'): ?>
        <div class="card p-4 animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0 text-dark"><i class="fas fa-list me-2 text-primary"></i>Kendaraan di Dalam</h4>
                <div style="width: 300px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" id="searchInput" class="form-control bg-light border-0 small shadow-none" placeholder="Cari Plat Nomor...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-muted small">
                            <th>PLAT NOMOR</th>
                            <th>JENIS</th>
                            <th>WAKTU MASUK</th>
                            <th>AREA</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $listDalam = $model->getKendaraanDalam();
                        if(mysqli_num_rows($listDalam) == 0): ?>
                            <tr><td colspan='5' class='text-center py-5 text-muted'>Tidak ada kendaraan di dalam.</td></tr>
                        <?php endif;
                        while($row = mysqli_fetch_assoc($listDalam)): ?>
                        <tr class="fw-medium">
                            <td class="fw-bold text-primary fs-5"><?= $row['plat_nomor'] ?></td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary px-3 text-capitalize"><?= $row['jenis_kendaraan'] ?></span></td>
                            <td class="text-muted"><?= date('H:i | d M Y', strtotime($row['waktu_masuk'])) ?></td>
                            <td><span class="badge bg-info bg-opacity-10 text-info px-3 fw-bold"><?= $row['nama_area'] ?></span></td>
                            <td class="text-center">
                                <form method="POST" action="../../Controller/PetugasController.php" style="display:inline;">
                                    <input type="hidden" name="id_parkir" value="<?= $row['id_parkir'] ?>">
                                    <button type="submit" name="proses_keluar" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                                        Check-Out <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif($page == 'struk_masuk' || $page == 'struk_keluar'): ?>
        <?php
            $id = $_GET['id'] ?? 0;
            $is_keluar = ($page == 'struk_keluar');
            $d = $model->getTransaksiDetail($id, $is_keluar);
        ?>
        <div class="row justify-content-center animate__animated animate__zoomIn">
            <div class="col-md-12">
                <div class="struk-card shadow-sm text-center">
                    <h5 class="fw-bold mb-0">E-PARKING SYSTEM</h5>
                    <p class="text-muted small mb-0">Bukti Parkir Digital</p>
                    <small class="fw-bold text-primary">No. Struk: #PRK-<?= str_pad($d['id_parkir'], 5, '0', STR_PAD_LEFT) ?></small>
                    <hr style="border-style: dashed;">
                    <div class="my-3">
                        <small class="text-muted d-block">PLAT NOMOR</small>
                        <h2 class="fw-bold mb-0"><?= strtoupper($d['plat_nomor']) ?></h2>
                    </div>
                    <div class="text-start mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Jenis</span>
                            <span class="fw-bold small"><?= ucwords($d['jenis_kendaraan']) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Masuk</span>
                            <span class="small"><?= date('d/m/y H:i', strtotime($d['waktu_masuk'])) ?></span>
                        </div>
                        <?php if($is_keluar): ?>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Keluar</span>
                                <span class="small"><?= date('d/m/y H:i', strtotime($d['waktu_keluar'])) ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                <span class="text-muted fw-bold small">DURASI</span>
                                <span class="fw-bold small"><?= $d['durasi_jam'] ?> Jam</span>
                            </div>
                            <div class="mt-3 p-3 bg-light rounded-3 text-center">
                                <span class="text-muted small d-block mb-1">TOTAL TAGIHAN</span>
                                <h3 class="fw-bold text-dark mb-0">Rp <?= number_format($d['biaya_total'],0,',','.') ?></h3>
                            </div>
                        <?php else: ?>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Area</span>
                                <span class="fw-bold small"><?= $d['nama_area'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="small text-muted italic mb-4">Simpan struk ini sebagai bukti resmi.</p>
                    <div class="no-print gap-2 d-flex">
                        <button onclick="window.print()" class="btn btn-primary w-100 fw-bold">Cetak</button>
                        <a href="?page=<?= $is_keluar ? 'transaksi_keluar' : 'transaksi_masuk' ?>" class="btn btn-outline-secondary w-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });

    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');
        if (msg === 'checkin_success') Toast.fire({ icon: 'success', title: 'Check-In Berhasil!' });
        if (msg === 'checkout_success') Toast.fire({ icon: 'success', title: 'Check-Out Berhasil!' });

        const searchInput = document.getElementById('searchInput');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                let filter = this.value.toUpperCase();
                let rows = document.querySelectorAll("#tableBody tr");
                rows.forEach(row => {
                    let platCol = row.getElementsByTagName("td")[0];
                    if (platCol) {
                        let textValue = platCol.textContent || platCol.innerText;
                        row.style.display = textValue.toUpperCase().includes(filter) ? "" : "none";
                    }
                });
            });
        }
    });

    document.querySelector('.logout-link').addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('href');
        Swal.fire({
            title: 'Logout dari sistem?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            confirmButtonText: 'Ya, Keluar'
        }).then((result) => { if (result.isConfirmed) window.location.href = url; });
    });
</script>
</body>
</html>
