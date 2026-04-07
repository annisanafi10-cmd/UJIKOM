<div class="container-fluid">
    <!-- Welcome Banner Soft -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 24px; background: linear-gradient(135deg, #e3f2fd 0%, #f0f4ff 100%); overflow: hidden; position: relative;">
                <div style="position: absolute; top: -40px; right: -40px; width: 150px; height: 150px; background: rgba(144, 202, 249, 0.2); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -20px; left: -20px; width: 100px; height: 100px; background: rgba(144, 202, 249, 0.15); border-radius: 50%;"></div>
                <div class="card-body p-4" style="position: relative; z-index: 1;">
                    <h3 class="fw-bold mb-1" style="color: #1976d2;">Halo, <?= $_SESSION['nama'] ?>! 👋</h3>
                    <p class="text-muted mb-0">Cek status peminjaman alatmu secara real-time di sini</p>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // Filter data peminjaman
    $pinjaman_aktif = array_filter($myPeminjaman ?? [], function($p) {
        return in_array($p['status'], ['menunggu', 'disetujui']);
    });
    $pinjaman_menunggu = array_filter($myPeminjaman ?? [], function($p) {
        return $p['status'] === 'menunggu';
    });
    
    $total_aktif = count($pinjaman_aktif);
    $total_menunggu = count($pinjaman_menunggu);
    $total_semua = count($myPeminjaman ?? []);
    
    $ada_barang_dipinjam = $total_aktif > 0;
    $belum_pernah_pinjam = $total_semua === 0;
    ?>

    <!-- Stats Cards Pastel -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #fff9c4 0%, #fff59d 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 60px; height: 60px; background: rgba(245, 127, 23, 0.15); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-stack" style="font-size: 1.8rem; color: #f57f17;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold">PINJAMAN SAYA</small>
                            <h3 class="fw-bold mb-0" style="color: #f57f17;"><?= $total_aktif ?> Data</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #e1bee7 0%, #ce93d8 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div style="width: 60px; height: 60px; background: rgba(106, 27, 154, 0.15); border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="bi bi-hourglass-split" style="font-size: 1.8rem; color: #6a1b9a;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold">MENUNGGU</small>
                            <h3 class="fw-bold mb-0" style="color: #6a1b9a;"><?= $total_menunggu ?> Pengajuan</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($belum_pernah_pinjam): ?>
        <!-- Belum pernah pinjam -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 24px; background: linear-gradient(135deg, #e1f5fe 0%, #b3e5fc 100%); overflow: hidden; position: relative;">
            <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(255,255,255,0.3); border-radius: 50%;"></div>
            <div class="card-body py-5 text-center" style="position: relative; z-index: 1;">
                <div class="mb-3" style="font-size: 4rem;">📦</div>
                <h5 class="fw-bold mb-2" style="color: #01579b;">Barang apa yang hari ini mau kamu pinjam?</h5>
                <p class="text-muted mb-4">Yuk mulai ajukan peminjaman alat yang kamu butuhkan!</p>
                <a href="index.php?page=daftar_alat" class="btn btn-primary shadow-sm" style="border-radius: 12px; padding: 12px 30px; background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%); border: none;">
                    <i class="bi bi-search me-2"></i>Lihat Daftar Alat
                </a>
            </div>
        </div>
    <?php elseif ($ada_barang_dipinjam): ?>
        <!-- Lagi pinjam -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius: 20px; background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%); border-left: 6px solid #ffb74d !important;">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-circle-fill me-2" style="font-size: 1.5rem; color: #f57f17;"></i>
                    <span class="fw-bold" style="color: #f57f17;">Ingat: Kamu punya barang yang harus dikembalikan!</span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #f5f9ff 0%, #e8f4f8 100%);">
            <div class="card-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-sm table-borderless mb-0">
                        <thead class="text-muted small">
                            <tr>
                                <th>NAMA ALAT</th>
                                <th class="text-center">JUMLAH</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-end">TGL KEMBALI</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold" style="color: #1e293b;">
                            <?php foreach ($pinjaman_aktif as $p): ?>
                            <tr style="border-top: 1px solid #e2e8f0;">
                                <td class="pt-3"><?= htmlspecialchars($p['nama_alat']) ?></td>
                                <td class="pt-3 text-center"><?= $p['jumlah'] ?></td>
                                <td class="pt-3 text-center">
                                    <?php if ($p['status'] == 'menunggu'): ?>
                                        <span class="badge-soft-warning" style="font-size: 11px;">MENUNGGU</span>
                                    <?php else: ?>
                                        <span class="badge-soft-success" style="font-size: 11px;">DISETUJUI</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pt-3 text-end" style="color: #f57f17;"><?= !empty($p['tgl_kembali']) ? date('d M Y', strtotime($p['tgl_kembali'])) : '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Udah pernah pinjam tapi udah dikembalikan semua -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 24px; background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%); overflow: hidden; position: relative;">
            <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(255,255,255,0.3); border-radius: 50%;"></div>
            <div class="card-body py-5 text-center" style="position: relative; z-index: 1;">
                <div class="mb-3" style="font-size: 4rem;">✅</div>
                <h5 class="fw-bold mb-2" style="color: #2e7d32;">Terima kasih sudah mengembalikan barang tepat waktu!</h5>
                <p class="text-muted mb-0">Semua pinjamanmu sudah selesai. Butuh alat lain?</p>
            </div>
        </div>
    <?php endif; ?>
</div>