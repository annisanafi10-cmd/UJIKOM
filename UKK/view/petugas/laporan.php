<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
        <div>
            <h2 class="font-weight-bold mb-1" style="color: #1e293b;">Laporan Pengembalian</h2>
            <p class="text-muted small">Riwayat alat yang sudah dikembalikan.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary shadow-sm" style="border-radius: 12px;" onclick="window.print()">
                <i class="bi bi-printer mr-1"></i> Cetak Laporan
            </button>
            <a class="btn btn-success shadow-sm" style="border-radius: 12px;" 
               href="index.php?page=laporan&export=csv">
                <i class="bi bi-file-earmark-excel mr-1"></i> Export CSV
            </a>
        </div>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="d-none d-print-block text-center mb-4">
            <h3 class="font-weight-bold">LAPORAN PENGEMBALIAN ALAT</h3>
            <p>Data alat yang sudah dikembalikan</p>
            <hr>
        </div>

        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>User</th>
                        <th>Nama Alat</th>
                        <th class="text-center">Qty</th>
                        <th>Catatan</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan)): ?>
                        <?php foreach ($laporan as $row): 
                            $st = strtolower($row['status']);
                            // Mapping status ke badge dan label
                            if ($st == 'kembali') {
                                $cls = 'badge-soft-success';
                                $label = 'DIKEMBALIKAN';
                            } elseif ($st == 'disetujui') {
                                $cls = 'badge-soft-info';
                                $label = 'DIPINJAM';
                            } elseif ($st == 'ditolak') {
                                $cls = 'badge-soft-danger';
                                $label = 'DITOLAK';
                            } else {
                                $cls = 'badge-soft-warning';
                                $label = 'MENUNGGU';
                            }
                        ?>
                        <tr>
                            <td class="small text-muted">#<?= $row['id_peminjaman'] ?></td>
                            <td>
                                <div class="font-weight-bold"><?= htmlspecialchars($row['nama_user']) ?></div>
                            </td>
                            <td><span class="badge-soft-secondary"><?= htmlspecialchars($row['nama_alat']) ?></span></td>
                            <td class="text-center font-weight-bold"><?= $row['jumlah'] ?></td>
                            <td>
                                <?php if (!empty($row['catatan'])): ?>
                                    <small class="text-muted"><?= htmlspecialchars($row['catatan']) ?></small>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><small><?= date('d/m/Y', strtotime($row['tgl_pinjam'])) ?></small></td>
                            <td><small><?= !empty($row['tgl_kembali']) ? date('d/m/Y', strtotime($row['tgl_kembali'])) : '-' ?></small></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted font-italic">
                                <i class="bi bi-search mr-2"></i> Tidak ada data ditemukan untuk rentang ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
@media print {
    /* Cuma sembunyikan header navbar aja */
    .navbar-top {
        display: none !important;
    }
    
    body { 
        background: white !important; 
        margin: 0 !important;
        padding: 15px !important;
    }
}
</style>