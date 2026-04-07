<div class="container-fluid p-4">
    <div class="mb-4">
        <h2 class="font-weight-bold mb-0" style="color: #1e293b;">Ajukan Peminjaman</h2>
        <p class="text-muted small mb-0">Isi form di bawah untuk mengajukan peminjaman alat</p>
    </div>

    <?php if (!empty($flash_success)): ?>
        <div class="alert alert-success border-0 shadow-sm" style="border-radius: 15px;"><?= htmlspecialchars($flash_success) ?></div>
    <?php endif; ?>
    <?php if (!empty($flash_error)): ?>
        <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 15px;"><?= htmlspecialchars($flash_error) ?></div>
    <?php endif; ?>

    <div class="main-table-card mb-4">
        <form method="post" action="index.php?page=ajukan_pinjam" id="formAjukan">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-3" style="color: #1e293b;">
                    <i class="bi bi-box-seam mr-2"></i>Detail Peminjaman
                </h6>
            <div class="mb-3">
                <label class="form-label font-weight-bold small text-muted">PILIH ALAT</label>
                <select name="id_alat" id="id_alat" class="form-control-custom w-100" required>
                    <option value="">-- Pilih Alat --</option>
                    <?php foreach ($dataAlat as $a): ?>
                        <option value="<?= $a['id_alat'] ?>" data-stok="<?= $a['stok'] ?>" <?= (!empty($selectedAlat) && $selectedAlat['id_alat'] == $a['id_alat']) ? 'selected' : '' ?>><?= htmlspecialchars($a['nama_alat']) ?> (stok: <?= $a['stok'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted">Stok tersedia: <span id="stokInfo" class="font-weight-bold text-primary">-</span></small>
            </div>

            <div class="mb-3">
                <label class="form-label font-weight-bold small text-muted">JUMLAH</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control-custom w-100" min="1" placeholder="Masukkan jumlah..." required>
            </div>

            <div class="mb-3">
                <label class="form-label font-weight-bold small text-muted">DURASI (HARI)</label>
                <select id="durasi" class="form-control-custom w-100">
                    <option value="0">Pilih durasi (opsional)</option>
                    <option value="1">1 hari</option>
                    <option value="2">2 hari</option>
                    <option value="3">3 hari</option>
                    <option value="7">1 minggu</option>
                </select>
                <small class="text-muted">Pilih durasi untuk mengisi otomatis Tgl Kembali</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold small text-muted">TGL PINJAM</label>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control-custom w-100" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold small text-muted">TGL KEMBALI</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control-custom w-100">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label font-weight-bold small text-muted">CATATAN (OPSIONAL)</label>
                <textarea name="catatan" id="catatan" class="form-control-custom w-100" rows="3" placeholder="Contoh: butuh untuk praktikum..." style="resize: none;"></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" name="submit" class="btn btn-primary btn-add-custom">Ajukan Peminjaman</button>
                <a href="index.php?page=dashboard" class="btn btn-secondary" style="border-radius: 12px; padding: 10px 20px;">Batal</a>
            </div>
            </div>
        </form>
    </div>

    <div class="main-table-card">
        <h5 class="font-weight-bold mb-3" style="color: #1e293b;">Riwayat Pengajuan Saya</h5>
        <div class="table-responsive">
            <table class="table table-aesthetic mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="pl-3">ID</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-center pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($myPeminjaman)): ?>
                        <?php foreach ($myPeminjaman as $row): ?>
                            <tr>
                                <td class="pl-3"><?= $row['id_peminjaman'] ?></td>
                                <td class="font-weight-bold"><?= htmlspecialchars($row['nama_alat']) ?></td>
                                <td class="text-center"><?= $row['jumlah'] ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tgl_pinjam'])) ?></td>
                                <td><?= !empty($row['tgl_kembali']) ? date('d/m/Y', strtotime($row['tgl_kembali'])) : '-' ?></td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 'menunggu'): ?>
                                        <span class="badge-soft-warning">MENUNGGU</span>
                                    <?php elseif ($row['status'] == 'disetujui'): ?>
                                        <span class="badge-soft-success">DISETUJUI</span>
                                    <?php elseif ($row['status'] == 'dibatalkan'): ?>
                                        <span class="badge-soft-secondary" style="background-color: #f1f5f9; color: #64748b; padding: 5px 12px; border-radius: 8px; font-weight: 700;">DIBATALKAN</span>
                                    <?php elseif ($row['status'] == 'kembali'): ?>
                                        <span class="badge-soft-primary">KEMBALI</span>
                                    <?php elseif ($row['status'] == 'ditolak'): ?>
                                        <span class="badge-soft-danger">DITOLAK</span>
                                        <?php if (!empty($row['alasan_tolak'])): ?>
                                            <br><small class="text-danger" style="font-size: 0.7rem;">
                                                <i class="bi bi-info-circle"></i> <?= htmlspecialchars($row['alasan_tolak']) ?>
                                            </small>
                                        <?php endif; ?>
                                    <?php elseif ($row['status'] == 'ditolak_kembali'): ?>
                                        <span class="badge-soft-danger">PENGEMBALIAN DITOLAK</span>
                                        <?php if (!empty($row['alasan_tolak_kembali'])): ?>
                                            <br><small class="text-danger" style="font-size: 0.7rem;">
                                                <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($row['alasan_tolak_kembali']) ?>
                                            </small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge-soft-info"><?= strtoupper($row['status'] ?? 'PROSES') ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center pr-3">
                                    <?php if ($row['status'] == 'menunggu'): ?>
                                        <a class="btn-soft-delete text-decoration-none" href="index.php?page=ajukan_pinjam&batal=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Batalkan pengajuan ini?')">
                                            <i class="bi bi-x-circle"></i> Batalkan
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center p-4 text-muted">Belum ada pengajuan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function updateStokInfo() {
    const sel = document.getElementById('id_alat');
    const stok = sel.options[sel.selectedIndex] ? sel.options[sel.selectedIndex].dataset.stok : '';
    document.getElementById('stokInfo').innerText = stok || '-';
    const jumlah = document.getElementById('jumlah');
    jumlah.max = stok || '';
}

function updateDurasi() {
    const dur = parseInt(document.getElementById('durasi').value || 0, 10);
    const tglPinjam = document.getElementById('tgl_pinjam').value;
    if (dur > 0 && tglPinjam) {
        const d = new Date(tglPinjam);
        d.setDate(d.getDate() + dur);
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        document.getElementById('tgl_kembali').value = `${yyyy}-${mm}-${dd}`;
    }
}

document.getElementById('id_alat').addEventListener('change', updateStokInfo);
document.getElementById('durasi').addEventListener('change', updateDurasi);
document.getElementById('tgl_pinjam').addEventListener('change', updateDurasi);

document.getElementById('formAjukan').addEventListener('submit', function(e){
    const sel = document.getElementById('id_alat');
    const stok = parseInt(sel.options[sel.selectedIndex]?.dataset.stok || 0, 10);
    const jumlah = parseInt(document.getElementById('jumlah').value || 0, 10);
    if (jumlah <= 0 || jumlah > stok) {
        alert('Jumlah tidak valid atau melebihi stok.');
        e.preventDefault();
    }
});

updateStokInfo();
</script>