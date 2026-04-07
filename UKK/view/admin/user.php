<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Manajemen User</h2>
            <p class="text-muted small mb-0">Kelola akun peminjam yang terdaftar.</p>
        </div>
        <button type="button" class="btn btn-primary btn-add-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            <i class="bi bi-person-plus mr-1"></i> Tambah User
        </button>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="pl-3">ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th class="text-center">Role</th>
                        <th class="text-right pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataUser)): ?>
                        <?php foreach ($dataUser as $u): ?>
                        <tr>
                            <td class="pl-3"><?= $u['id_user'] ?></td>
                            <td class="font-weight-bold">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-soft mr-2"><?= strtoupper(substr($u['nama'], 0, 1)) ?></div>
                                    <?= htmlspecialchars($u['nama']) ?>
                                </div>
                            </td>
                            <td class="text-muted"><?= htmlspecialchars($u['username'] ?? '-') ?></td>
                            <td class="text-center">
                                <?php
                                $roleClass = ['admin' => 'badge-soft-danger', 'petugas' => 'badge-soft-warning', 'peminjam' => 'badge-soft-info'];
                                $cls = $roleClass[$u['role']] ?? 'badge-soft-secondary';
                                ?>
                                <span class="<?= $cls ?>"><?= strtoupper($u['role']) ?></span>
                            </td>
                            <td class="text-right pr-3">
                                <?php if ($u['role'] === 'peminjam'): ?>
                                <button type="button" class="btn-soft-edit mr-1"
                                    onclick="showEditModal(<?= $u['id_user'] ?>, '<?= htmlspecialchars($u['nama'], ENT_QUOTES) ?>', '<?= htmlspecialchars($u['username'] ?? '', ENT_QUOTES) ?>')">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="index.php?page=user&hapus=<?= $u['id_user'] ?>"
                                   class="btn-soft-delete text-decoration-none"
                                   onclick="return confirm('Hapus user ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <?php else: ?>
                                <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center p-4 text-muted">Belum ada user.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <form action="index.php?page=user&aksi=tambah" method="POST">
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control-custom w-100" placeholder="Masukkan nama..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">USERNAME</label>
                        <input type="text" name="username" class="form-control-custom w-100" placeholder="Buat username..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">PASSWORD</label>
                        <input type="text" name="password" class="form-control-custom w-100" placeholder="Buat password..." required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <form action="index.php?page=user&aksi=edit" method="POST">
                <input type="hidden" name="id_user" id="edit_id">
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">NAMA LENGKAP</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control-custom w-100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">USERNAME</label>
                        <input type="text" name="username" id="edit_username" class="form-control-custom w-100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">PASSWORD BARU (kosongkan jika tidak diubah)</label>
                        <input type="text" name="password" class="form-control-custom w-100" placeholder="Isi jika ingin ganti password...">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showEditModal(id, nama, username) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_username').value = username;
    new bootstrap.Modal(document.getElementById('modalEditUser')).show();
}
</script>
