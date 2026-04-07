<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-1" style="color: #1e293b;">Persetujuan Peminjaman</h2>
        <p class="text-muted small">Kelola dan tinjau permintaan peminjaman alat dari siswa atau guru.</p>
    </div>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card-monitoring shadow-sm p-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-circle bg-soft-amber mr-3">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Butuh ACC Segera</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?= $stats['totalPerluDisetujui'] ?> Antrean</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card-monitoring shadow-sm p-3 border-bottom-primary" style="border-bottom: 5px solid #4f46e5 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-circle bg-soft-blue mr-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Sedang Dipinjam</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?= $stats['totalAktif'] ?> Alat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card-monitoring shadow-sm p-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-circle bg-soft-success mr-3">
                            <i class="bi bi-check2-all"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Selesai/Kembali</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?= $stats['totalPengembalian'] ?> Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="card-header bg-transparent border-0 py-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <h5 class="font-weight-bold mb-3 mb-md-0" style="color: #1e293b;">Daftar Permintaan</h5>
            <div class="btn-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <a href="index.php?page=menyetujui" class="btn btn-sm <?= !isset($_GET['filter']) ? 'btn-primary' : 'btn-light text-muted' ?> px-3 py-2">Semua Riwayat</a>
                <a href="index.php?page=menyetujui&filter=menunggu" class="btn btn-sm <?= @$_GET['filter'] == 'menunggu' ? 'btn-warning' : 'btn-light text-muted' ?> px-3 py-2">
                    <i class="bi bi-clock-history mr-1"></i> Butuh ACC
                </a>
            </div>
        </div>

        <div class="table-responsive px-2 pb-3">
            <table class="table table-aesthetic">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat & Qty</th>
                        <th>Alasan/Catatan</th>
                        <th>Tgl Pinjam</th>
                        <th>Status</th>
                        <?php if(@$_GET['filter'] == 'menunggu'): ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $adaData = false;
                    foreach ($data as $p): 
                        if (isset($_GET['filter']) && $_GET['filter'] == 'menunggu' && $p['status'] !== 'menunggu') continue;
                        $adaData = true;

                        $badgeClass = 'badge-soft-secondary';
                        if($p['status'] == 'menunggu') $badgeClass = 'badge-soft-warning';
                        elseif($p['status'] == 'disetujui') $badgeClass = 'badge-soft-success';
                        elseif($p['status'] == 'ditolak') $badgeClass = 'badge-soft-danger';
                        elseif($p['status'] == 'kembali') $badgeClass = 'badge-soft-info';
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-soft mr-2"><?= strtoupper(substr($p['nama'], 0, 1)); ?></div>
                                <div>
                                    <div class="font-weight-bold" style="color: #1e293b;"><?= htmlspecialchars($p['nama']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold text-dark"><?= htmlspecialchars($p['nama_alat']) ?></div>
                            <small class="badge-soft-info" style="font-size: 0.7rem; padding: 2px 8px;"><?= $p['jumlah'] ?> Unit</small>
                        </td>
                        <td style="max-width: 200px;">
                            <span class="small text-muted italic">
                                "<?= !empty($p['catatan']) ? htmlspecialchars($p['catatan']) : 'Tidak ada catatan.' ?>"
                            </span>
                        </td>
                        <td>
                            <div class="small font-weight-bold"><i class="bi bi-calendar3 mr-1"></i> <?= date('d/m/Y', strtotime($p['tgl_pinjam'])) ?></div>
                        </td>
                        <td>
                            <span class="<?= $badgeClass ?>">
                                <?= strtoupper(htmlspecialchars($p['status'])) ?>
                            </span>
                        </td>
                        <?php if(@$_GET['filter'] == 'menunggu'): ?>
                            <td class="text-center">
                                <div class="d-flex flex-column gap-2">
                                    <a href="index.php?page=menyetujui&setuju=<?= $p['id_peminjaman'] ?>" 
                                       class="btn-action-soft bg-soft-success text-success text-decoration-none"
                                       onclick="return confirm('Setujui permintaan ini?')">
                                       <i class="bi bi-check-circle-fill"></i> Setujui
                                    </a>
                                    <button type="button" 
                                       class="btn-action-soft bg-soft-danger text-danger"
                                       onclick="showTolakModal(<?= $p['id_peminjaman'] ?>)">
                                       <i class="bi bi-x-circle-fill"></i> Tolak
                                    </button>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tolak Peminjaman -->
<div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <form method="GET" action="index.php">
                <input type="hidden" name="page" value="menyetujui">
                <input type="hidden" name="tolak" id="tolak_id">
                
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold">Tolak Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">ALASAN PENOLAKAN</label>
                        <textarea name="alasan_tolak" class="form-control-custom w-100" rows="4" 
                                  placeholder="Contoh: Stok tidak mencukupi, alat sedang diperbaiki, dll..." 
                                  required style="resize: none;"></textarea>
                        <small class="text-muted">Alasan ini akan dilihat oleh peminjam</small>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 12px;">
                        <i class="bi bi-x-circle mr-1"></i> Tolak Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showTolakModal(id) {
    document.getElementById('tolak_id').value = id;
    var modal = new bootstrap.Modal(document.getElementById('modalTolak'));
    modal.show();
}
</script>
