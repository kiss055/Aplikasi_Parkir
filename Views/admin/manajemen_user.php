<?php
require_once __DIR__ . '/../../Model/AdminModel.php';
$model = new AdminModel($conn);

// Ambil semua data user melalui Model
$qUser   = $model->getAllUsers();
$action  = $_GET['action'] ?? '';
$idEdit  = $_GET['id'] ?? '';
$no = 1;

// DATA EDIT: Ambil dari Model jika aksi adalah edit
$edit = ['id_user' => '', 'nama_lengkap' => '', 'username' => '', 'role' => ''];
if($action == 'edit' && $idEdit){
    $dataEdit = $model->getUserById($idEdit);
    if($dataEdit) {
        $edit = $dataEdit;
    }
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    .card-user { border: none; border-radius: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); background: white; }
    .table thead th { background-color: #f8f9fc; color: #4e73df; font-weight: 700; text-transform: uppercase; font-size: 12px; padding: 15px; }
    .badge-admin { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-petugas { background: #e0e7ff; color: #4f46e5; border: 1px solid #c7d2fe; }
    .badge-owner { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .btn-edit-custom { background-color: #198754; color: white; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.3s; text-decoration: none; border:none; }
    .btn-delete-custom { background-color: #dc3545; color: white; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: none; transition: 0.3s; }
    .avatar-circle { width: 35px; height: 35px; background: #4e73df; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; }
    
    .modal { background: rgba(0, 0, 0, 0.5) !important; }
    .modal-backdrop { display: none !important; } 
</style>

<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold text-gray-800 m-0">Manajemen Pengguna</h3>
            <p class="text-muted small m-0">Kelola hak akses admin, petugas, dan owner.</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus-circle me-2"></i>Tambah User
        </button>
    </div>

    <div class="card card-user p-4">
        <div class="table-responsive">
            <table id="tabelUser" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Profil Pengguna</th>
                        <th>Username</th>
                        <th>Hak Akses</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($u = mysqli_fetch_assoc($qUser)): 
                        $role = strtolower($u['role']);
                        $badgeClass = ($role == 'admin') ? 'badge-admin' : (($role == 'petugas') ? 'badge-petugas' : 'badge-owner');
                        $inisial = strtoupper(substr($u['nama_lengkap'] ?? 'U', 0, 1));
                    ?>
                    <tr>
                        <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3 shadow-sm"><?= $inisial ?></div>
                                <div>
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($u['nama_lengkap']) ?></span>
                                    <small class="text-muted">ID: #<?= $u['id_user'] ?></small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-primary border px-2 py-1">@<?= htmlspecialchars($u['username']) ?></span></td>
                        <td>
                            <span class="badge <?= $badgeClass ?> px-3 py-2 rounded-pill">
                                <i class="fas fa-shield-alt me-1 small"></i> <?= ucfirst($u['role']) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="?page=user&action=edit&id=<?= $u['id_user'] ?>" class="btn-edit-custom shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn-delete-custom shadow-sm" onclick="hapusUser(<?= $u['id_user'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold"><i class="fas fa-user-plus me-2 text-primary"></i>Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../../Controller/UserController.php">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light border-0 py-2" placeholder="Nama lengkap..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Username</label>
                        <input type="text" name="username" class="form-control bg-light border-0 py-2" placeholder="Username..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Password</label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-2" placeholder="********" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Role / Jabatan</label>
                        <select name="role" class="form-select bg-light border-0 py-2">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan_user" class="btn btn-primary px-4 shadow-sm">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if($action == 'edit'): ?>
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-top border-warning border-5">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold text-dark"><i class="fas fa-user-edit me-2 text-warning"></i>Edit User</h5>
                <a href="?page=user" class="btn-close"></a>
            </div>
            <form method="post" action="../../Controller/UserController.php">
                <input type="hidden" name="id_user" value="<?= $edit['id_user'] ?>">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light border-0 py-2" value="<?= htmlspecialchars($edit['nama_lengkap']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Username</label>
                        <input type="text" name="username" class="form-control bg-light border-0 py-2" value="<?= htmlspecialchars($edit['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Ganti Password <small class="text-danger">(Kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-2">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Role</label>
                        <select name="role" class="form-select bg-light border-0 py-2">
                            <option value="admin" <?= $edit['role']=='admin'?'selected':'' ?>>Admin</option>
                            <option value="petugas" <?= $edit['role']=='petugas'?'selected':'' ?>>Petugas</option>
                            <option value="owner" <?= $edit['role']=='owner'?'selected':'' ?>>Owner</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <a href="?page=user" class="btn btn-light px-4">Batal</a>
                    <button type="submit" name="update_user" class="btn btn-success px-4 shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#tabelUser')) {
            $('#tabelUser').DataTable({
                "language": { "search": "Cari:", "info": "Total _TOTAL_ user" }
            });
        }

        <?php if($action == 'edit'): ?>
            var el = document.getElementById('modalEdit');
            if(el){
                var myModal = new bootstrap.Modal(el);
                myModal.show();
            }
        <?php endif; ?>

        $('.modal').on('hidden.bs.modal', function () {
            $('body').removeClass('modal-open').css('padding-right', '');
            $('.modal-backdrop').remove();
        });
    });

    function hapusUser(id){
        Swal.fire({
            title: 'Hapus akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if(result.isConfirmed) window.location = '../../Controller/UserController.php?hapus=' + id;
        });
    }
</script>
