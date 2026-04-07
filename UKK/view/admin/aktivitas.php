<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Log Aktivitas</h2>
        <p class="text-muted small mb-0">Riwayat login dan logout semua pengguna.</p>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th class="pl-3">Waktu</th>
                        <th>Nama Pengguna</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $l): ?>
                        <tr>
                            <td class="pl-3">
                                <small class="text-muted">
                                    <i class="bi bi-clock mr-1"></i>
                                    <?= date('d/m/Y H:i', strtotime($l['waktu'])) ?>
                                </small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-soft mr-2"><?= strtoupper(substr($l['nama_user'], 0, 1)) ?></div>
                                    <span class="font-weight-bold"><?= htmlspecialchars($l['nama_user']) ?></span>
                                </div>
                            </td>
                            <td>
                                <?php $isLogin = strpos($l['aktivitas'], 'Login') !== false; ?>
                                <span class="<?= $isLogin ? 'badge-soft-success' : 'badge-soft-danger' ?>">
                                    <i class="bi bi-<?= $isLogin ? 'box-arrow-in-right' : 'box-arrow-right' ?> mr-1"></i>
                                    <?= htmlspecialchars($l['aktivitas']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center p-4 text-muted">Belum ada riwayat aktivitas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
