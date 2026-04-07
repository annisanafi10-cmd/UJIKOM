<div class="container-fluid">
    <!-- Welcome Header Pastel -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 24px; background: linear-gradient(135deg, #e3f2fd 0%, #f0f4ff 50%, #fff8e1 100%); overflow: hidden; position: relative;">
                <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(144, 202, 249, 0.2); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255, 224, 130, 0.2); border-radius: 50%;"></div>
                <div class="card-body p-5" style="position: relative; z-index: 1;">
                    <h2 class="fw-bold mb-2" style="color: #1976d2;">Selamat Datang Kembali, <?= $_SESSION['nama']; ?>! 👋</h2>
                    <p class="mb-0 text-muted">Kelola sistem peminjaman alat dengan mudah dan efisien</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Pastel -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #bbdefb 0%, #e3f2fd 100%); overflow: hidden; position: relative;">
                <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255,255,255,0.3); border-radius: 50%;"></div>
                <div class="card-body p-4" style="position: relative; z-index: 1;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-muted" style="font-size: 0.9rem;">Total Alat Terdaftar</p>
                            <h1 class="fw-bold mb-0" style="font-size: 3rem; color: #1976d2;"><?= $totalAlat ?? 0; ?></h1>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(25, 118, 210, 0.15); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-tools" style="font-size: 2rem; color: #1976d2;"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-arrow-up-right me-1"></i>
                        <small>Item dalam sistem</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #f8bbd0 0%, #fce4ec 100%); overflow: hidden; position: relative;">
                <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255,255,255,0.3); border-radius: 50%;"></div>
                <div class="card-body p-4" style="position: relative; z-index: 1;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-muted" style="font-size: 0.9rem;">Kategori Alat</p>
                            <h1 class="fw-bold mb-0" style="font-size: 3rem; color: #c2185b;"><?= $totalKategori ?? 0; ?></h1>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(194, 24, 91, 0.15); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-tag" style="font-size: 2rem; color: #c2185b;"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-grid me-1"></i>
                        <small>Jenis berbeda</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #b2dfdb 0%, #e0f2f1 100%); overflow: hidden; position: relative;">
                <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255,255,255,0.3); border-radius: 50%;"></div>
                <div class="card-body p-4" style="position: relative; z-index: 1;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-muted" style="font-size: 0.9rem;">Sedang Dipinjam</p>
                            <h1 class="fw-bold mb-0" style="font-size: 3rem; color: #00796b;"><?= $totalDipinjam ?? 0; ?></h1>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(0, 121, 107, 0.15); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-box-arrow-right" style="font-size: 2rem; color: #00796b;"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <i class="bi bi-people me-1"></i>
                        <small>Alat aktif dipinjam</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peringatan Stok Rendah -->
    <?php if (!empty($alatStokRendah)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; border-left: 6px solid #ffb74d !important; background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3" style="color: #f57f17;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>⚠️ Stok Alat Menipis!
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Stok Tersisa</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($alatStokRendah as $alat): ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($alat['nama_alat']) ?></td>
                                    <td><span class="badge-soft-info"><?= htmlspecialchars($alat['nama_kategori']) ?></span></td>
                                    <td class="text-center">
                                        <span class="badge-soft-danger"><?= $alat['stok'] ?> unit</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="index.php?page=alat&aksi=edit&id=<?= $alat['id_alat'] ?>" class="btn btn-sm" style="background: #ffb74d; color: white; border-radius: 10px;">
                                            <i class="bi bi-pencil me-1"></i>Update
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>