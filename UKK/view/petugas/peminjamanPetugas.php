<div class="container-fluid">
    <h2 class="mb-4">📋 Data Peminjaman</h2>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_user'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($row['nama_alat'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['jumlah'] ?? 0); ?></td>
                            <td><?= htmlspecialchars($row['tgl_pinjam'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($row['tgl_kembali'] ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    (($row['status'] === 'menunggu') ? 'warning' : 
                                    (($row['status'] === 'dipinjam') ? 'info' : 
                                    (($row['status'] === 'dikembalikan') ? 'success' : 'danger')))
                                ?>">
                                    <?= ucfirst($row['status'] ?? 'unknown'); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data peminjaman.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
