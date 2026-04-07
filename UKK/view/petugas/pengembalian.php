<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-1" style="color: #1e293b;">
            <i class="bi bi-display text-primary mr-2"></i> Monitoring Pengembalian
        </h2>
        <p class="text-muted small">Pantau alat yang masih dibawa peminjam dan proses pengembaliannya.</p>
    </div>

    <div class="main-table-card shadow-sm">
        <div class="card-header bg-transparent border-0 py-4">
            <h5 class="font-weight-bold mb-0" style="color: #1e293b;">
                <i class="bi bi-box-arrow-in-left mr-2 text-primary"></i> Barang yang Masih Dibawa Peminjam
            </h5>
        </div>

        <div class="table-responsive px-2 pb-4">
            <table class="table table-aesthetic">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat & Qty</th>
                        <th>Catatan</th>
                        <th>Batas Kembali</th>
                        <th class="text-center">Sisa Waktu</th>
                        <th class="text-right pr-4">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Memfilter data yang statusnya 'disetujui' (masih dipinjam)
                    $dataPinjam = array_filter($data, fn($i) => $i['status'] == 'disetujui');

                    if (empty($dataPinjam)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-check-circle text-success" style="font-size: 3rem; opacity: 0.3;"></i>
                                    <p class="text-muted mt-3 font-weight-bold">SEMUA BARANG SUDAH KEMBALI</p>
                                    <small class="text-muted">Tidak ada pinjaman aktif saat ini.</small>
                                </div>
                            </td>
                        </tr>
                    <?php else: foreach ($dataPinjam as $p): 
                        // Logika perhitungan waktu tetap di view karena terkait presentasi
                        $tgl_pinjam = new DateTime($p['tgl_pinjam']);
                        $deadline = clone $tgl_pinjam;
                        $deadline->modify('+3 days'); 
                        $sekarang = new DateTime();
                        $is_telat = $sekarang > $deadline;
                        $selisih = $sekarang->diff($deadline);
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-soft mr-2"><?= strtoupper(substr($p['nama_user'], 0, 1)); ?></div>
                                <div>
                                    <div class="font-weight-bold" style="color: #1e293b;"><?= htmlspecialchars($p['nama_user']) ?></div>
                                    <small class="badge-soft-secondary" style="font-size: 0.7rem;">ID: <?= htmlspecialchars($p['id_user']) ?></small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="badge-soft-info d-inline-block px-3 py-1 mb-1">
                                <i class="bi bi-laptop mr-1"></i> <?= htmlspecialchars($p['nama_alat']) ?>
                            </div>
                            <div class="small text-muted font-weight-bold ml-1">
                                Jumlah: <?= $p['jumlah'] ?> Unit
                            </div>
                        </td>

                        <td>
                            <?php if (!empty($p['catatan'])): ?>
                                <div class="small text-muted" style="max-width: 150px;">
                                    <i class="bi bi-chat-text mr-1"></i>
                                    <?= htmlspecialchars($p['catatan']) ?>
                                </div>
                            <?php else: ?>
                                <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="font-weight-bold <?= $is_telat ? 'text-danger' : 'text-dark' ?>" style="font-size: 1rem;">
                                <?= $deadline->format('d M Y') ?>
                            </div>
                            <small class="text-muted">Pinjam: <?= $tgl_pinjam->format('d/m/y') ?></small>
                        </td>

                        <td class="text-center">
                            <?php if ($is_telat): ?>
                                <span class="badge-soft-danger px-3 py-2 d-inline-block w-100" style="border: 1px solid #fecaca; border-radius: 10px;">
                                    <i class="bi bi-clock-history mr-1"></i> TELAT <?= $selisih->days ?> HARI
                                </span>
                            <?php else: ?>
                                <span class="badge-soft-warning px-3 py-2 d-inline-block w-100" style="border: 1px solid #fef3c7; border-radius: 10px;">
                                    <i class="bi bi-hourglass-split mr-1"></i> Sisa <?= $selisih->days ?> Hari
                                </span>
                            <?php endif; ?>
                        </td>

                        <td class="text-right pr-4">
                            <div class="d-flex flex-column gap-2">
                                <a href="index.php?page=pengembalian&aksi=proses&id=<?= $p['id_peminjaman'] ?>" 
                                   class="btn-action-soft bg-primary text-white shadow-sm text-decoration-none"
                                   onclick="return confirm('Konfirmasi barang sudah kembali dengan kondisi baik?')">
                                    <i class="bi bi-check-circle mr-1"></i> TERIMA
                                </a>
                                <button type="button"
                                   class="btn-action-soft bg-danger text-white shadow-sm"
                                   onclick="showTolakKembaliModal(<?= $p['id_peminjaman'] ?>)">
                                    <i class="bi bi-x-circle mr-1"></i> TOLAK
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Pengembalian -->
    <div class="main-table-card shadow-sm mt-4">
        <div class="card-header bg-transparent border-0 py-4">
            <h5 class="font-weight-bold mb-0" style="color: #1e293b;">
                <i class="bi bi-clock-history mr-2 text-success"></i> Riwayat Pengembalian
            </h5>
        </div>

        <div class="table-responsive px-2 pb-4">
            <table class="table table-aesthetic">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Catatan</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Filter data yang sudah dikembalikan
                    $dataKembali = array_filter($data, function($item) {
                        return $item['status'] === 'kembali';
                    });
                    
                    if (empty($dataKembali)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <span class="text-muted">Belum ada riwayat pengembalian</span>
                            </td>
                        </tr>
                    <?php else: foreach ($dataKembali as $r): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-soft mr-2"><?= strtoupper(substr($r['nama_user'], 0, 1)); ?></div>
                                <div>
                                    <span class="font-weight-bold"><?= htmlspecialchars($r['nama_user']) ?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-soft-secondary"><?= htmlspecialchars($r['nama_alat']) ?></span>
                            <small class="d-block text-muted">Qty: <?= $r['jumlah'] ?></small>
                        </td>
                        <td>
                            <?php if (!empty($r['catatan'])): ?>
                                <small class="text-muted"><?= htmlspecialchars($r['catatan']) ?></small>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><small><?= date('d/m/Y', strtotime($r['tgl_pinjam'])) ?></small></td>
                        <td><small><?= date('d/m/Y', strtotime($r['tgl_kembali'])) ?></small></td>
                        <td class="text-center">
                            <span class="badge-soft-success">DIKEMBALIKAN</span>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tolak Pengembalian -->
<div class="modal fade" id="modalTolakKembali" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <form method="GET" action="index.php">
                <input type="hidden" name="page" value="pengembalian">
                <input type="hidden" name="aksi" value="tolak">
                <input type="hidden" name="id" id="tolak_kembali_id">
                
                <div class="modal-header border-0 bg-light p-4">
                    <h5 class="modal-title font-weight-bold text-danger">
                        <i class="bi bi-exclamation-triangle mr-2"></i>Tolak Pengembalian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="alert alert-warning border-0" style="border-radius: 12px;">
                        <i class="bi bi-info-circle mr-2"></i>
                        <small>Pengembalian ditolak jika barang rusak, tidak lengkap, atau kondisi tidak sesuai.</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-muted">ALASAN PENOLAKAN</label>
                        <textarea name="alasan_tolak_kembali" class="form-control-custom w-100" rows="4" 
                                  placeholder="Contoh: Barang rusak, tidak lengkap, kotor, dll..." 
                                  required style="resize: none;"></textarea>
                        <small class="text-muted">Alasan ini akan dilihat oleh peminjam</small>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 12px;">
                        <i class="bi bi-x-circle mr-1"></i> Tolak Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showTolakKembaliModal(id) {
    document.getElementById('tolak_kembali_id').value = id;
    var modal = new bootstrap.Modal(document.getElementById('modalTolakKembali'));
    modal.show();
}
</script>
