<?php
// Cegah akses langsung tanpa controller
if (!isset($data)) {
    header("Location: ../../Controller/OwnerController.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Owner Dashboard | Smart Parking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --sidebar-width: 260px;
}

body { 
    background: #f8fafc; 
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    background: var(--primary-gradient);
    position: fixed;
    left: 0; top: 0;
    z-index: 1000;
}

.sidebar-header { padding: 30px 25px; text-align: center; }

.logo-icon {
    width: 55px; height: 55px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 10px;
    backdrop-filter: blur(5px);
    color: white; font-size: 24px;
}

.sidebar-menu { padding: 0 18px; }

.sidebar a {
    color: rgba(255, 255, 255, 0.8);
    display: flex; align-items: center;
    padding: 14px 18px;
    text-decoration: none;
    border-radius: 12px;
    margin-bottom: 8px;
    transition: 0.3s;
}

.sidebar a:hover { background: rgba(255, 255, 255, 0.1); color: white; }

.sidebar a.active {
    background: white; 
    color: #667eea; 
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.main-content { margin-left: var(--sidebar-width); padding: 40px; }

.stat-card {
    border: none; 
    border-radius: 20px; 
    padding: 25px;
    background: white; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    position: relative; 
    overflow: hidden;
}

.table-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.05);
}

.table-scroll-container {
    max-height: 450px; 
    overflow-y: auto;  
    overflow-x: auto;  
}

.table thead th {
    position: sticky;
    top: 0;
    background-color: #f8fafc;
    z-index: 10;
    border-bottom: 2px solid #eee;
    white-space: nowrap;
}

.table-scroll-container::-webkit-scrollbar { width: 6px; height: 6px; }
.table-scroll-container::-webkit-scrollbar-track { background: #f1f1f1; }
.table-scroll-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

.filter-card {
    background: white; 
    border-radius: 20px; 
    padding: 25px;
    margin-bottom: 30px; 
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.btn-filter {
    background: var(--primary-gradient);
    border: none; 
    color: white; 
    font-weight: 600; 
    border-radius: 10px;
    padding: 10px 25px;
}

@media print {
    .sidebar, .filter-card, .btn-print, .btn-excel, .no-print { display: none !important; }
    .main-content { margin-left: 0; padding: 0; }
    .table-scroll-container { max-height: none !important; overflow: visible !important; }
}
</style>
</head>

<body>

<div class="sidebar no-print">
    <div class="sidebar-header">
        <div class="logo-icon"><i class="fas fa-chart-line"></i></div>
        <h5 class="fw-bold text-white mb-0">OWNER PANEL</h5>
        <small class="text-white-50">Monitoring Laporan</small>
    </div>
    <div class="sidebar-menu">
        <a href="?page=rekap" class="active">
            <i class="fas fa-file-invoice-dollar me-2"></i> Rekap Transaksi
        </a>
        <a href="../../Controller/logout.php" class="text-warning mt-5 logout-link">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">

<div class="d-flex justify-content-between align-items-center mb-4 no-print">
    <h3 class="fw-bold m-0">Laporan Pendapatan</h3>
    <div class="d-flex gap-2">
        <button id="btnExport" class="btn btn-success btn-excel rounded-pill px-4">
            <i class="fas fa-file-excel me-2"></i> Export Excel
        </button>
        <button onclick="window.print()" class="btn btn-outline-primary btn-print rounded-pill px-4">
            <i class="fas fa-print me-2"></i> Cetak PDF
        </button>
    </div>
</div>

<div class="filter-card no-print">
    <form method="POST" action="../../Controller/OwnerController.php" class="row align-items-end g-3">
        <div class="col-md-4">
            <label class="form-label small fw-bold text-muted">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" class="form-control rounded-3" value="<?= $tgl_mulai ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-bold text-muted">Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" class="form-control rounded-3" value="<?= $tgl_selesai ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-filter w-100">
                <i class="fas fa-filter me-2"></i> Terapkan Filter
            </button>
        </div>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <i class="fas fa-wallet" style="position:absolute;right:-10px;bottom:-10px;font-size:80px;color:rgba(102,126,234,0.05);"></i>
            <span class="text-muted small fw-bold text-uppercase">Total Pendapatan</span>
            <h2 class="fw-bold text-primary mt-1" id="display-total">Rp 0</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="stat-card">
            <i class="fas fa-car" style="position:absolute;right:-10px;bottom:-10px;font-size:80px;color:rgba(102,126,234,0.05);"></i>
            <span class="text-muted small fw-bold text-uppercase">Total Kendaraan</span>
            <h2 class="fw-bold text-dark mt-1"><?= $jumlah_transaksi ?> <small class="fs-6 text-muted">Unit</small></h2>
        </div>
    </div>
</div>

<div class="table-card animate__animated animate__fadeInUp">
<div class="table-scroll-container">
<table id="tableLaporan" class="table table-hover align-middle mb-0" style="min-width: 900px;">
<thead>
<tr>
<th class="ps-4">No. Plat</th>
<th>Jenis</th>
<th>Waktu Masuk</th>
<th>Waktu Keluar</th>
<th>Durasi</th>
<th>Petugas</th>
<th class="text-end pe-4">Biaya</th>
</tr>
</thead>
<tbody>

<?php if (!empty($data)) : ?>
<?php foreach ($data as $row): ?>
<tr>
<td class="ps-4 fw-bold text-dark"><?= $row['plat_nomor'] ?></td>
<td><span class="badge bg-light text-primary border px-3 text-capitalize"><?= $row['jenis_kendaraan'] ?></span></td>
<td class="small text-muted"><?= date('d/m/y H:i', strtotime($row['waktu_masuk'])) ?></td>
<td class="small text-muted"><?= date('d/m/y H:i', strtotime($row['waktu_keluar'])) ?></td>
<td class="fw-medium"><?= $row['durasi_jam'] ?> Jam</td>
<td class="small"><?= $row['petugas'] ?? '-' ?></td>
<td class="text-end pe-4 fw-bold text-success">
Rp <?= number_format($row['biaya_total'], 0, ',', '.') ?>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
<td colspan="7" class="text-center py-5 text-muted">
Tidak ada data transaksi pada periode ini.
</td>
</tr>
<?php endif; ?>

</tbody>
</table>
</div>
</div>

</div>

<script>
document.getElementById('display-total').innerText =
'Rp <?= number_format($total_pendapatan, 0, ",", ".") ?>';

document.getElementById('btnExport').addEventListener('click', function() {
let table = document.getElementById("tableLaporan");
TableToExcel.convert(table, {
name: "Laporan_SmartParking_<?= $tgl_mulai ?>_to_<?= $tgl_selesai ?>.xlsx",
sheet: { name: "Rekap Transaksi" }
});
Swal.fire({
icon: 'success',
title: 'Berhasil!',
text: 'Laporan sedang diunduh...',
timer: 2000,
showConfirmButton: false
});
});

document.querySelector('.logout-link').addEventListener('click', function(e) {
e.preventDefault();
const logoutUrl = this.getAttribute('href');
Swal.fire({
title: 'Keluar dari Panel?',
icon: 'question',
showCancelButton: true,
confirmButtonColor: '#667eea',
confirmButtonText: 'Ya, Logout',
reverseButtons: true
}).then((result) => {
if (result.isConfirmed) window.location.href = logoutUrl;
});
});
</script>

</body>
</html>