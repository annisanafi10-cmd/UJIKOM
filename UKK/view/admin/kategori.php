<div class="container-fluid p-4">
    <?php if (!empty($flash_success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($flash_success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($flash_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($flash_error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Manajemen Kategori</h2>
            <p class="text-muted small mb-0">Kelompokkan alat inventaris agar lebih terorganisir.</p>
        </div>
        <button class="btn btn-primary btn-add-custom shadow-sm" onclick="openModal()">
            <i class="bi bi-plus-lg mr-1"></i> Tambah Kategori
        </button>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="10%" class="pl-3">ID</th>
                        <th>Nama Kategori</th>
                        <th width="15%" class="text-right pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($dataKategori as $k): ?>
                    <tr>
                        <td class="pl-3"><?= $no++; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-tag-fill mr-2 text-primary" style="opacity: 0.5;"></i>
                                <span class="font-weight-bold"><?= htmlspecialchars($k['nama_kategori']); ?></span>
                            </div>
                        </td>
                        <td class="text-right pr-3">
                            <button class="btn btn-sm btn-outline-primary me-2" onclick="editKategori(<?= $k['id_kategori'] ?>, '<?= htmlspecialchars($k['nama_kategori'], ENT_QUOTES) ?>')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="index.php?page=kategori&hapus=1&id=<?= $k['id_kategori']; ?>" 
                               class="btn btn-sm btn-outline-danger text-decoration-none" 
                               onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalKategori" class="modal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
    <div class="modal-content border-0 shadow-lg" style="background: white; margin: 10% auto; width: 35%; border-radius: 20px; overflow: hidden;">
        <div class="modal-header border-0 bg-light p-4 d-flex justify-content-between align-items-center">
            <h5 class="modal-title font-weight-bold mb-0">Tambah Kategori Baru</h5>
            <span onclick="closeModal()" style="cursor:pointer; font-size: 24px; color: #94a3b8;">&times;</span>
        </div>
        <form method="POST" action="index.php?page=kategori">
            <input type="hidden" name="form_action" value="tambah">
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label font-weight-bold small text-muted">NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" class="form-control-custom w-100" placeholder="Contoh: Elektronik, Furnitur..." required>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary px-4" onclick="closeModal()">Batal</button>
                <button type="submit" name="submit" value="1" class="btn btn-success px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditKategori" class="modal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
    <div class="modal-content border-0 shadow-lg" style="background: white; margin: 10% auto; width: 35%; border-radius: 20px; overflow: hidden;">
        <div class="modal-header border-0 bg-light p-4 d-flex justify-content-between align-items-center">
            <h5 class="modal-title font-weight-bold mb-0">Edit Kategori</h5>
            <span onclick="closeEditModal()" style="cursor:pointer; font-size: 24px; color: #94a3b8;">&times;</span>
        </div>
        <form method="POST" action="index.php?page=kategori">
            <input type="hidden" name="form_action" value="edit">
            <div class="modal-body p-4">
                <input type="hidden" name="id_kategori" id="edit_id_kategori">
                <div class="mb-3">
                    <label class="form-label font-weight-bold small text-muted">NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" id="edit_nama_kategori" class="form-control-custom w-100" placeholder="Contoh: Elektronik, Furnitur..." required>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary px-4" onclick="closeEditModal()">Batal</button>
                <button type="submit" name="update" value="1" class="btn btn-success px-4">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() { document.getElementById('modalKategori').style.display = 'block'; }
function closeModal() { document.getElementById('modalKategori').style.display = 'none'; }

function editKategori(id, nama) {
    document.getElementById('edit_id_kategori').value = id;
    document.getElementById('edit_nama_kategori').value = nama;
    document.getElementById('modalEditKategori').style.display = 'block';
}
function closeEditModal() { document.getElementById('modalEditKategori').style.display = 'none'; }

window.onclick = function(e) { 
    if (e.target == document.getElementById('modalKategori')) closeModal(); 
    if (e.target == document.getElementById('modalEditKategori')) closeEditModal(); 
}
</script>