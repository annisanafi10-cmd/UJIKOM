<div class="container-fluid p-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4" style="background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%); border-radius: 24px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="h3 mb-1 font-weight-bold" style="color: #1e293b;">Selamat Datang, Petugas! 👋</h1>
                        <p class="text-muted mb-0">Sistem Peminjaman Alat - <span class="badge-soft-info">Dashboard Monitoring</span></p>
                    </div>
                    <div class="d-none d-md-block" style="opacity: 0.5;">
                        <i class="bi bi-shield-check-fill text-primary" style="font-size: 3.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card-monitoring shadow-sm p-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-circle bg-soft-amber mr-3">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1" style="letter-spacing: 1px;">Butuh ACC Segera</div>
                           <div class="h4 mb-0 font-weight-bold" style="color: #1e293b;"><?= $stats['totalPerluDisetujui'] ?? 0; ?> Antrean</div>
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
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1" style="letter-spacing: 1px;">Sedang Dipinjam</div>
                            <div class="h4 mb-0 font-weight-bold" style="color: #1e293b;"><?= $stats['totalAktif'] ?? 0; ?> Alat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card-monitoring shadow-sm p-3 border-bottom-danger" style="border-bottom: 5px solid #ef4444 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon-circle bg-soft-rose mr-3">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1" style="letter-spacing: 1px;">Terlambat Kembali</div>
                            <div class="h4 mb-0 font-weight-bold" style="color: #1e293b;"><?= $stats['totalTerlambat'] ?? 0; ?> Data</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-table-card shadow-sm mt-2 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-weight-bold mb-0" style="color: #1e293b;">
                <i class="bi bi-clock-history mr-2 text-primary"></i> 5 Pengembalian Terakhir
            </h5>
            <a href="index.php?page=pengembalian" class="btn btn-outline-primary btn-sm rounded-pill px-4 font-weight-bold">Lihat Semua</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-aesthetic">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-folder2-open text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="text-muted mt-3 font-italic">Belum ada data pengembalian yang tercatat.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>