<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-0" style="color: #1e293b;">📋 Manajemen Peminjaman</h2>
        <p class="text-muted small">Pantau status peminjaman alat secara real-time.</p>
    </div>
    
    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="pl-3">ID</th>
                        <th>User</th>
                        <th>Alat & Qty</th>
                        <th>Alasan/Catatan</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-right pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td class="pl-3"><?= $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-soft mr-2"><?= strtoupper(substr($row['nama_user'], 0, 1)); ?></div>
                                    <div>
                                        <div class="font-weight-bold" style="color: #1e293b;"><?= htmlspecialchars($row['nama_user']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark"><?= htmlspecialchars($row['nama_alat']); ?></div>
                                <small class="badge-soft-info" style="font-size: 0.7rem; padding: 2px 8px;"><?= $row['jumlah']; ?> Unit</small>
                            </td>
                            <td style="max-width: 200px;">
                                <span class="small text-muted italic">
                                    "<?= !empty($row['catatan']) ? htmlspecialchars($row['catatan']) : 'Tidak ada catatan.'; ?>"
                                </span>
                            </td>
                            <td><small class="text-muted"><i class="bi bi-calendar-event"></i> <?= date('d/m/Y', strtotime($row['tgl_pinjam'])); ?></small></td>
                            <td><small class="text-muted"><?= !empty($row['tgl_kembali']) ? date('d/m/Y', strtotime($row['tgl_kembali'])) : '-'; ?></small></td>
                            <td class="text-center">
                                <?php 
                                    $s = $row['status'];
                                    if ($s == 'menunggu') {
                                        $cls = 'badge-soft-warning';
                                        $label = 'MENUNGGU';
                                    } elseif ($s == 'disetujui') {
                                        $cls = 'badge-soft-info';
                                        $label = 'DIPINJAM';
                                    } elseif ($s == 'kembali') {
                                        $cls = 'badge-soft-success';
                                        $label = 'DIKEMBALIKAN';
                                    } elseif ($s == 'ditolak') {
                                        $cls = 'badge-soft-danger';
                                        $label = 'DITOLAK';
                                    } else {
                                        $cls = 'badge-soft-secondary';
                                        $label = strtoupper($s);
                                    }
                                ?>
                                <span class="<?= $cls; ?>"><?= $label; ?></span>
                            </td>
                            <td class="text-right pr-3">
                                <a href="index.php?page=peminjaman&hapus=<?= $row['id_peminjaman']; ?>" class="btn-soft-delete text-decoration-none" onclick="return confirm('Hapus?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>