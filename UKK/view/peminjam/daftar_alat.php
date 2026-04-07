<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Katalog Alat Tersedia</h2>
        <p class="text-muted small mb-0">Pilih alat yang ingin dipinjam</p>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="pl-3">No</th>
                        <th>ID Alat</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Status</th>
                        <th class="text-center pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftarAlat)): ?>
                        <?php $no = 1; foreach ($daftarAlat as $alat): ?>
                        <tr>
                            <td class="pl-3"><?= $no++; ?></td>
                            <td><?= $alat['id_alat'] ?></td>
                            <td class="font-weight-bold"><?= htmlspecialchars($alat['nama_alat']) ?></td>
                            <td><span class="badge-soft-info"><?= htmlspecialchars($alat['nama_kategori'] ?? '-') ?></span></td>
                            <td class="text-center"><?= $alat['stok'] ?></td>
                            <td class="text-center">
                                <?php if ($alat['stok'] > 0): ?>
                                    <span class="badge-soft-success">Tersedia</span>
                                <?php else: ?>
                                    <span class="badge-soft-danger">Kosong</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pr-3">
                                <?php if ($alat['stok'] > 0): ?>
                                    <a href="index.php?page=ajukan_pinjam&id_alat=<?= $alat['id_alat'] ?>" 
                                       class="btn btn-sm btn-primary" style="border-radius: 8px;">
                                        Pinjam Sekarang
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled style="border-radius: 8px;">
                                        Stok Habis
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center p-4 text-muted">Belum ada alat tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>