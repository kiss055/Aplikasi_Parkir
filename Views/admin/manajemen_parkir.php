<?php
require_once __DIR__ . '/../../Model/AdminModel.php';
$model = new AdminModel($conn);

// Proteksi Akses
if(!isset($_SESSION['login']) || $_SESSION['role']!='admin'){
    header("Location: ../auth/login.php");
    exit;
}

// Inisialisasi Tab dan Edit ID
$tab = $_GET['tab'] ?? 'tarif';
$editId = $_GET['edit'] ?? null;
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    .nav-pills .nav-link {
        border-radius: 12px; padding: 12px 25px; color: #4e73df;
        font-weight: 600; background: #fff; margin-right: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: 0.3s;
    }
    .nav-pills .nav-link.active { background: linear-gradient(45deg, #4e73df, #224abe); color: white; }
    .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    .form-control-custom { border-radius: 10px; border: 1px solid #e3e6f0; padding: 12px; }
    .btn-action { width: 35px; height: 35px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; transition: 0.3s; text-decoration: none; }
    .btn-edit { background: #198754; color: white; border: none; }
    .btn-delete { background: #dc3545; color: white; border: none; }
    .btn-edit:hover, .btn-delete:hover { transform: translateY(-3px); color: white; }
</style>

<div class="container-fluid animate__animated animate__fadeIn">
    <?php if(isset($_SESSION['alert'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '<?= $_SESSION['alert']['icon'] ?>',
                    title: '<?= $_SESSION['alert']['title'] ?>',
                    text: '<?= $_SESSION['alert']['text'] ?>',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    <?php unset($_SESSION['alert']); endif; ?>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold text-gray-800 m-0">Pengaturan Layanan Parkir</h3>
    </div>

    <ul class="nav nav-pills mb-4" id="pills-tab">
        <li class="nav-item">
            <a class="nav-link <?= $tab=='tarif'?'active':'' ?>" href="?page=parkir&tab=tarif">
                <i class="fas fa-tags me-2"></i>Tarif Parkir
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $tab=='area'?'active':'' ?>" href="?page=parkir&tab=area">
                <i class="fas fa-map-marked-alt me-2"></i>Area Parkir
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $tab=='kendaraan'?'active':'' ?>" href="?page=parkir&tab=kendaraan">
                <i class="fas fa-car me-2"></i>Data Kendaraan
            </a>
        </li>
    </ul>

    <?php if($tab=='tarif'): 
        $edit = ($editId) ? $model->getTarifById($editId) : null;
        $qTarif = $model->getAllTarif();
    ?>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card card-custom p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-4 text-primary"><?= $edit ? 'Edit Tarif' : 'Atur Tarif Baru' ?></h5>
                    <form method="post" action="../../Controller/ParkirController.php">
                        <input type="hidden" name="id_tarif" value="<?= $edit['id_tarif'] ?? '' ?>">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan" class="form-select form-control-custom" required>
                                <option value="motor" <?= (($edit['jenis_kendaraan'] ?? '') == 'motor') ? 'selected' : '' ?>>Motor</option>
                                <option value="mobil" <?= (($edit['jenis_kendaraan'] ?? '') == 'mobil') ? 'selected' : '' ?>>Mobil</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Tarif / Jam (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">Rp</span>
                                <input type="number" name="tarif_per_jam" class="form-control form-control-custom border-0 bg-light" value="<?= $edit['tarif_per_jam'] ?? '' ?>" placeholder="3000" required>
                            </div>
                        </div>
                        <button type="submit" name="<?= $edit ? 'update_tarif' : 'tambah_tarif' ?>" class="btn <?= $edit ? 'btn-success' : 'btn-primary' ?> w-100 py-2 fw-bold rounded-3 shadow-sm">
                            <?= $edit ? 'Simpan Perubahan' : 'Simpan Tarif' ?>
                        </button>
                        <?php if($edit): ?> <a href="?page=parkir&tab=tarif" class="btn btn-light w-100 mt-2">Batal</a> <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-custom p-4">
                    <table class="table table-hover align-middle datatable-init">
                        <thead class="bg-light">
                            <tr><th>No</th><th>Jenis</th><th>Biaya / Jam</th><th class="text-center">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php $no=1; while($t = mysqli_fetch_assoc($qTarif)): ?>
                            <tr>
                                <td width="5%"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas <?= ($t['jenis_kendaraan'] ?? '')=='motor'?'fa-motorcycle':'fa-car' ?> me-2 text-primary"></i>
                                        <strong><?= ucfirst($t['jenis_kendaraan'] ?? '') ?></strong>
                                    </div>
                                </td>
                                <td class="fw-bold text-success">Rp <?= number_format($t['tarif_per_jam'] ?? 0,0,',','.') ?></td>
                                <td class="text-center">
                                    <a href="?page=parkir&tab=tarif&edit=<?= $t['id_tarif'] ?>" class="btn-action btn-edit me-1 shadow-sm"><i class="fas fa-edit"></i></a>
                                    <button onclick="confirmHapus('tarif', <?= $t['id_tarif'] ?>)" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($tab=='area'): 
        $edit = ($editId) ? $model->getAreaById($editId) : null;
        $qArea = $model->getAllAreas();
    ?>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card card-custom p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-4 text-primary"><?= $edit ? 'Edit Area Parkir' : 'Tambah Area Parkir' ?></h5>
                    <form method="post" action="../../Controller/ParkirController.php">
                        <input type="hidden" name="id_area" value="<?= $edit['id_area'] ?? '' ?>">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Area</label>
                            <input type="text" name="nama_area" class="form-control form-control-custom" value="<?= htmlspecialchars($edit['nama_area'] ?? '') ?>" placeholder="Gedung A" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Total Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control form-control-custom" value="<?= $edit['kapasitas'] ?? '' ?>" placeholder="0" required>
                        </div>
                        <button type="submit" name="<?= $edit ? 'update_area' : 'tambah_area' ?>" class="btn <?= $edit ? 'btn-success' : 'btn-primary' ?> w-100 py-2 fw-bold shadow-sm">
                            <?= $edit ? 'Simpan Perubahan' : 'Tambah Area' ?>
                        </button>
                        <?php if($edit): ?> <a href="?page=parkir&tab=area" class="btn btn-light w-100 mt-2">Batal</a> <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-custom p-4">
                    <table class="table table-hover align-middle datatable-init">
                        <thead><tr><th>Area</th><th>Status Kapasitas</th><th class="text-center">Aksi</th></tr></thead>
                        <tbody>
                            <?php while($a = mysqli_fetch_assoc($qArea)): 
                                $kap = (int)($a['kapasitas'] ?? 0);
                                $terisi = (int)($a['terisi'] ?? 0);
                                $persen = ($kap > 0) ? ($terisi / $kap) * 100 : 0;
                                $color = ($persen > 80) ? 'bg-danger' : 'bg-success';
                            ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($a['nama_area'] ?? '') ?></strong></td>
                                <td width="50%">
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-3" style="height: 10px; border-radius: 5px;">
                                            <div class="progress-bar <?= $color ?> animate__animated animate__slideInLeft" style="width: <?= $persen ?>%"></div>
                                        </div>
                                        <small class="fw-bold"><?= $terisi ?>/<?= $kap ?></small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="?page=parkir&tab=area&edit=<?= $a['id_area'] ?>" class="btn-action btn-edit me-1 shadow-sm"><i class="fas fa-edit"></i></a>
                                    <button onclick="confirmHapus('area', <?= $a['id_area'] ?>)" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($tab=='kendaraan'): 
        $edit = ($editId) ? $model->getKendaraanById($editId) : null;
        $qKendaraan = $model->getAllKendaraan();
    ?>
        <div class="card card-custom p-4 mb-4 border-top border-primary border-5">
            <h5 class="fw-bold mb-4 text-primary"><?= $edit?'<i class="fas fa-edit me-2"></i>Edit':'<i class="fas fa-plus-circle me-2"></i>Tambah' ?> Kendaraan Member</h5>
            <form method="post" action="../../Controller/ParkirController.php">
                <input type="hidden" name="id_kendaraan" value="<?= $edit['id_kendaraan'] ?? '' ?>">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="small fw-bold">Nomor Plat</label>
                        <input name="plat_nomor" class="form-control form-control-custom bg-light" placeholder="B 1234 ABC" value="<?= htmlspecialchars($edit['plat_nomor'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="small fw-bold">Jenis</label>
                        <select name="jenis_kendaraan" class="form-select form-control-custom bg-light" required>
                            <option value="Motor" <?= (($edit['jenis_kendaraan'] ?? '') == 'Motor') ? 'selected' : '' ?>>Motor</option>
                            <option value="Mobil" <?= (($edit['jenis_kendaraan'] ?? '') == 'Mobil') ? 'selected' : '' ?>>Mobil</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold">Warna</label>
                        <input name="warna" class="form-control form-control-custom bg-light" placeholder="Hitam" value="<?= htmlspecialchars($edit['warna'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="small fw-bold">Nama Pemilik</label>
                        <input name="pemilik" class="form-control form-control-custom bg-light" placeholder="Nama lengkap pemilik" value="<?= htmlspecialchars($edit['pemilik'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <?php if($edit): ?> <a href="?page=parkir&tab=kendaraan" class="btn btn-light px-4 me-2">Batal</a> <?php endif; ?>
                    <button type="submit" name="<?= $edit?'update_kendaraan':'tambah_kendaraan' ?>" class="btn <?= $edit?'btn-success':'btn-primary' ?> px-5 py-2 shadow-sm fw-bold">
                        <?= $edit?'Simpan Perubahan':'Daftarkan Kendaraan' ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="card card-custom p-4">
            <table class="table table-hover align-middle datatable-init">
                <thead><tr><th>No</th><th>No Plat</th><th>Jenis</th><th>Warna</th><th>Pemilik</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    <?php $no=1; while($k = mysqli_fetch_assoc($qKendaraan)): ?>
                    <tr>
                        <td width="5%"><?= $no++ ?></td>
                        <td><span class="badge bg-dark px-3 py-2" style="letter-spacing: 1px;"><?= htmlspecialchars($k['plat_nomor'] ?? '') ?></span></td>
                        <td><i class="fas <?= strtolower($k['jenis_kendaraan'] ?? '')=='motor'?'fa-motorcycle':'fa-car' ?> me-2"></i><?= htmlspecialchars($k['jenis_kendaraan'] ?? '') ?></td>
                        <td><?= htmlspecialchars($k['warna'] ?? '') ?></td>
                        <td class="fw-bold text-primary"><?= htmlspecialchars($k['pemilik'] ?? '-') ?></td>
                        <td class="text-center">
                            <a href="?page=parkir&tab=kendaraan&edit=<?= $k['id_kendaraan'] ?>" class="btn-action btn-edit me-1 shadow-sm"><i class="fas fa-edit"></i></a>
                            <button onclick="confirmHapus('kendaraan', <?= $k['id_kendaraan'] ?>)" class="btn-action btn-delete shadow-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('.datatable-init').DataTable({
        "language": { "search": "Cari data:", "lengthMenu": "Tampil _MENU_", "paginate": { "next": "→", "previous": "←" } }
    });
});

function confirmHapus(tipe, id) {
    Swal.fire({
        title: 'Hapus data ini?',
        text: "Data akan hilang permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../../Controller/ParkirController.php?hapus=" + tipe + "&id=" + id;
        }
    })
}
</script>
