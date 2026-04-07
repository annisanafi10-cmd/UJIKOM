<div class="container-fluid p-4">

    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
            <i class="bi bi-check-circle me-2"></i>
            <?= $_SESSION['flash_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>
    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
            <i class="bi bi-exclamation-circle me-2"></i>
            <?= $_SESSION['flash_error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Data Alat</h2>
            <p class="text-muted small mb-0">Kelola daftar inventaris alat kantor dengan mudah.</p>
        </div>
        <button type="button" class="btn btn-primary btn-add-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
            <i class="bi bi-plus-lg mr-1"></i> Tambah Alat
        </button>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="pl-3">ID</th>
                        <th>Kategori</th>
                        <th>Nama Alat</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Status</th> 
                        <th class="text-right pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataAlat)): ?>
                        <?php $no = 1; foreach ($dataAlat as $row): ?>
                        <tr>
                            <td class="pl-3"><?= $no++; ?></td>
                            <td><span class="badge-soft-info"><?= htmlspecialchars($row['nama_kategori']); ?></span></td>
                            <td class="font-weight-bold"><?= htmlspecialchars($row['nama_alat']); ?></td>
                            <td class="text-center"><?= $row['stok']; ?></td>
                            <td class="text-center">
                                <?php if ($row['stok'] > 0): ?>
                                    <span class="badge-soft-success">Tersedia</span>
                                <?php else: ?>
                                    <span class="badge-soft-danger">Kosong</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right pr-3">
                                <a href="index.php?page=alat&aksi=edit&id=<?= $row['id_alat']; ?>" class="btn-soft-edit mr-1 text-decoration-none">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="index.php?page=alat&aksi=hapus&id=<?= $row['id_alat']; ?>" class="btn-soft-delete text-decoration-none" onclick="return confirm('Hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-4 text-muted">Belum ada data alat.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahAlat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <form action="index.php?page=alat&aksi=tambah" method="POST">
                
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold">Tambah Alat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">KATEGORI</label>
                        <select name="id_kategori" class="form-control-custom w-100" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php 
                            $stmtK = $db->query("SELECT * FROM tb_kategori WHERE deleted_at IS NULL ORDER BY nama_kategori ASC");
                            while($k = $stmtK->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$k['id_kategori']}'>{$k['nama_kategori']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">NAMA ALAT</label>
                        <input type="text" name="nama_alat" class="form-control-custom w-100" placeholder="Masukkan nama alat...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">STOK AWAL</label>
                        <input type="number" name="stok" class="form-control-custom w-100" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" value="1" class="btn btn-success px-4">Simpan Alat</button>
                </div>
            </form>
        </div>
    </div>
</div>