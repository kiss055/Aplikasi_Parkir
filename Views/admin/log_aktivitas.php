<?php
require_once __DIR__ . '/../../Model/AdminModel.php';
$model = new AdminModel($conn);
$qLog = $model->getLogs();
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    /* Sembunyikan tabel saat loading agar tidak terlihat "berantakan" */
    #tabelLog { opacity: 0; transition: opacity 0.3s ease-in; }
    #tabelLog.ready { opacity: 1; }

    .card-log { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); background: #fff; overflow: hidden; }
    .card-header-custom { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border: none; }
    .table thead th { background-color: #f8fafc; text-transform: uppercase; font-size: 11px; letter-spacing: 1.2px; font-weight: 800; color: #64748b; border-bottom: 2px solid #f1f5f9; padding: 15px 20px !important; }
    .col-waktu { min-width: 180px; padding-left: 20px !important; }
    .time-badge { display: flex; align-items: center; gap: 10px; color: #475569; font-weight: 500; font-size: 14px; }
    .time-badge i { color: #667eea; font-size: 16px; }
    .badge-role { padding: 6px 14px; font-weight: 700; font-size: 11px; letter-spacing: 0.5px; }
    .badge-admin { background: #fee2e2; color: #ef4444; }
    .badge-petugas { background: #e0e7ff; color: #4f46e5; }
    .badge-owner { background: #fef3c7; color: #d97706; }
    .table tbody td { padding: 18px 20px !important; border-bottom: 1px solid #f1f5f9; }
</style>

<div class="container-fluid animate__animated animate__fadeIn">
    <div class="card card-log">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0"><i class="fas fa-clock-rotate-left me-2"></i> Audit Log Aktivitas Sistem</h5>
            <button onclick="location.reload()" class="btn btn-sm btn-light fw-bold rounded-pill px-3 shadow-sm">
                <i class="fas fa-arrows-rotate me-1 text-primary"></i> Refresh
            </button>
        </div>
        
        <div class="card-body p-0"> 
            <div class="table-responsive p-3">
                <table id="tabelLog" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th class="col-waktu">Waktu Terjadi</th>
                            <th>Nama Pengguna</th>
                            <th>Hak Akses</th>
                            <th>Detail Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($log = mysqli_fetch_assoc($qLog)): 
                            $role = strtolower($log['role']);
                            $roleClass = ($role == 'admin') ? 'badge-admin' : (($role == 'petugas') ? 'badge-petugas' : 'badge-owner');
                        ?>
                        <tr>
                            <td class="col-waktu" data-order="<?= strtotime($log['waktu_aktivitas']) ?>">
                                <div class="time-badge">
                                    <i class="far fa-clock"></i>
                                    <span><?= date('d M Y, H:i', strtotime($log['waktu_aktivitas'])) ?> <small class="text-muted">WIB</small></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($log['nama_lengkap']) ?>&background=random&size=32" class="rounded-circle me-3">
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($log['nama_lengkap']) ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-role <?= $roleClass ?> rounded-pill"><?= strtoupper($log['role']) ?></span>
                            </td>
                            <td>
                                <span class="text-secondary fw-medium"><?= htmlspecialchars($log['aktivitas']) ?></span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#tabelLog').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data",
                "search": "",
                "searchPlaceholder": "Cari aktivitas...",
                "paginate": { "next": "→", "previous": "←" }
            },
            "pageLength": 10,
            "order": [[ 0, "desc" ]],
            "drawCallback": function() {
                // Tambahkan class 'ready' setelah DataTables selesai memproses tabel
                $('#tabelLog').addClass('ready');
            }
        });

        $('.dataTables_filter input').addClass('form-control rounded-pill border-light shadow-sm px-3').css('width', '250px');
    });
</script>
