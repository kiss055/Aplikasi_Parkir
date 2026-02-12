<?php
// Memanggil Model
require_once __DIR__ . '/../../Model/AdminModel.php'; 
$model = new AdminModel($conn);

// 1. Ambil Statistik Ringkasan dari Model
$stats = $model->getDashboardStats();

// 2. Ambil Data Grafik (7 Hari Terakhir) dari Model
$qGrafik = $model->getTransactionChartData(7);

$tanggal = [];
$totalGrafik = [];
while($g = mysqli_fetch_assoc($qGrafik)){
    $tanggal[] = date('d M', strtotime($g['tanggal']));
    $totalGrafik[] = $g['total'];
}

// 3. Ambil Log Aktivitas Terakhir (Limit 5) dari Model
$qLog = $model->getLogs(5);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root { --primary: #4e73df; --success: #1cc88a; --info: #36b9cc; }
    .stat-card {
        border: none; border-left: 5px solid; border-radius: 12px;
        transition: transform 0.3s; background: #fff;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .card-user { border-left-color: var(--primary); }
    .card-car { border-left-color: var(--success); }
    .card-trans { border-left-color: var(--info); }
    .icon-circle {
        width: 50px; height: 50px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: #f8f9fc; font-size: 20px;
    }
    .chart-container { position: relative; height: 300px; }
    .timeline { position: relative; }
</style>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold text-gray-800 m-0">Dashboard Overview</h3>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card card-user p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengguna</div>
                        <h2 class="fw-bold mb-0"><?= number_format($stats['totalUser']) ?></h2>
                    </div>
                    <div class="icon-circle text-primary"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card card-car p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Kendaraan</div>
                        <h2 class="fw-bold mb-0"><?= number_format($stats['totalKendaraan']) ?></h2>
                    </div>
                    <div class="icon-circle text-success"><i class="fas fa-car"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card card-trans p-4 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi</div>
                        <h2 class="fw-bold mb-0"><?= number_format($stats['totalTransaksi']) ?></h2>
                    </div>
                    <div class="icon-circle text-info"><i class="fas fa-exchange-alt"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold m-0"><i class="fas fa-chart-line me-2 text-primary"></i>Tren Transaksi Parkir</h5>
                </div>
                <div class="chart-container">
                    <canvas id="grafikTransaksi"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card p-4 border-0 shadow-sm h-100">
                <h5 class="fw-bold mb-4"><i class="fas fa-history me-2 text-warning"></i>Aktivitas Terbaru</h5>
                <div class="timeline">
                    <?php if(mysqli_num_rows($qLog) > 0): ?>
                        <?php while($l = mysqli_fetch_assoc($qLog)): ?>
                            <div class="mb-3 border-bottom pb-2">
                                <small class="text-muted d-block" style="font-size: 11px;">
                                    <?= date('d M, H:i', strtotime($l['waktu_aktivitas'])) ?> WIB
                                </small>
                                <span class="fw-bold text-primary"><?= htmlspecialchars($l['nama_lengkap']) ?></span>
                                <p class="mb-0 text-dark small"><?= htmlspecialchars($l['aktivitas']) ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">Belum ada aktivitas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('grafikTransaksi');
    
    // Create Gradient for Chart
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(78, 115, 223, 0.2)');
    gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($tanggal) ?>,
            datasets: [{
                label: 'Transaksi',
                data: <?= json_encode($totalGrafik) ?>,
                borderColor: '#4e73df',
                backgroundColor: gradient,
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4e73df',
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { drawBorder: false, color: '#f8f9fc' } 
                },
                x: { 
                    grid: { display: false } 
                }
            }
        }
    });
</script>
