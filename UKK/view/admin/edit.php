<div class="container-fluid p-4">
    <div class="mb-4 d-flex align-items-center">
        <a href="index.php?page=alat" class="btn btn-light shadow-sm mr-3" style="border-radius: 12px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Edit Alat</h2>
            <p class="text-muted small mb-0">Perbarui informasi inventaris barang.</p>
        </div>
    </div>

    <div class="main-table-card shadow-sm p-4">
        <form action="index.php?page=alat&aksi=update" method="POST">
            <input type="hidden" name="id_alat" value="<?= $alat['id_alat']; ?>">

            <div class="row">
                <div class="col-md-12 mb-4">
                    <label class="form-label font-weight-bold small text-muted text-uppercase">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control-custom w-100" 
                           value="<?= htmlspecialchars($alat['nama_alat']); ?>" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label font-weight-bold small text-muted text-uppercase">Kategori Alat</label>
                    <select name="id_kategori" class="form-control-custom w-100" required>
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>" <?= ($k['id_kategori'] == $alat['id_kategori']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($k['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label font-weight-bold small text-muted text-uppercase">Jumlah Stok</label>
                    <input type="number" name="stok" class="form-control-custom w-100" 
                           value="<?= $alat['stok']; ?>" min="0" required>
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">

            <div class="d-flex justify-content-end">
                <a href="index.php?page=alat" class="btn btn-light px-4 mr-2" style="border-radius: 12px;">Batal</a>
                <button type="submit" name="update" class="btn btn-primary btn-add-custom px-5">
                    <i class="bi bi-check-lg mr-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>