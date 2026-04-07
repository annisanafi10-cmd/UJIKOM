<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($_SESSION['role'] ?? 'User') ?> - Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body style="background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);">

<!-- Top Navbar -->
<nav class="navbar-top">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo & Title -->
            <div class="d-flex align-items-center">
                <div class="logo-circle">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="ms-3">
                    <h5 class="mb-0 fw-bold">Sistem Peminjaman</h5>
                    <small class="text-muted">Panel <?= ucfirst($_SESSION['role']) ?></small>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="nav-menu">
                <?php 
                $current_page = $_GET['page'] ?? 'dashboard'; 
                ?>

                <a href="index.php?page=dashboard" class="nav-item <?= ($current_page == 'dashboard') ? 'active' : '' ?>">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="index.php?page=alat" class="nav-item <?= ($current_page == 'alat') ? 'active' : '' ?>">
                        <i class="bi bi-tools"></i>
                        <span>Alat</span>
                    </a>
                    <a href="index.php?page=kategori" class="nav-item <?= ($current_page == 'kategori') ? 'active' : '' ?>">
                        <i class="bi bi-tag"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="index.php?page=peminjaman" class="nav-item <?= ($current_page == 'peminjaman') ? 'active' : '' ?>">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="index.php?page=log" class="nav-item <?= ($current_page == 'log') ? 'active' : '' ?>">
                        <i class="bi bi-clock-history"></i>
                        <span>Log</span>
                    </a>
                    <a href="index.php?page=user" class="nav-item <?= ($current_page == 'user') ? 'active' : '' ?>">
                        <i class="bi bi-people"></i>
                        <span>User</span>
                    </a>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'petugas'): ?>
                    <a href="index.php?page=menyetujui" class="nav-item <?= ($current_page == 'menyetujui') ? 'active' : '' ?>">
                        <i class="bi bi-check-circle"></i>
                        <span>Persetujuan</span>
                    </a>
                    <a href="index.php?page=pengembalian" class="nav-item <?= ($current_page == 'pengembalian') ? 'active' : '' ?>">
                        <i class="bi bi-arrow-return-left"></i>
                        <span>Pengembalian</span>
                    </a>
                    <a href="index.php?page=laporan" class="nav-item <?= ($current_page == 'laporan') ? 'active' : '' ?>">
                        <i class="bi bi-printer"></i>
                        <span>Laporan</span>
                    </a>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'peminjam'): ?>
                    <a href="index.php?page=daftar_alat" class="nav-item <?= ($current_page == 'daftar_alat') ? 'active' : '' ?>">
                        <i class="bi bi-search"></i>
                        <span>Daftar Alat</span>
                    </a>
                    <a href="index.php?page=ajukan_pinjam" class="nav-item <?= ($current_page == 'ajukan_pinjam') ? 'active' : '' ?>">
                        <i class="bi bi-pencil-square"></i>
                        <span>Ajukan</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- User Profile -->
            <div class="user-profile">
                <div class="dropdown">
                    <button class="profile-btn" type="button" data-bs-toggle="dropdown">
                        <div class="avatar-circle">
                            <?= strtoupper(substr($_SESSION['nama'], 0, 1)) ?>
                        </div>
                        <div class="ms-2 text-start">
                            <div class="fw-bold"><?= $_SESSION['nama'] ?></div>
                            <small class="text-muted"><?= ucfirst($_SESSION['role']) ?></small>
                        </div>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="index.php?page=logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="main-content">

<?php if (!empty($_SESSION['flash_logout'])): ?>
<div id="logoutToast" style="position:fixed; top:20px; right:20px; z-index:9999; min-width:280px;">
    <div style="background:white; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,0.12); padding:16px 20px; display:flex; align-items:center; gap:12px; border-left:4px solid #e57373;">
        <div style="width:36px;height:36px;background:#fff5f5;border-radius:10px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-box-arrow-right" style="color:#e57373;font-size:18px;"></i>
        </div>
        <div>
            <div style="font-weight:700;color:#1e293b;font-size:14px;">Sampai jumpa!</div>
            <div style="color:#64748b;font-size:13px;">Kamu berhasil logout 👋</div>
        </div>
        <button onclick="document.getElementById('logoutToast').remove()" style="margin-left:auto;background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
    </div>
</div>
<script>setTimeout(()=>{const t=document.getElementById('logoutToast');if(t)t.remove();},3000);</script>
<?php unset($_SESSION['flash_logout']); endif; ?>

<?php if (!empty($_SESSION['flash_login'])): ?>
<div id="loginToast" style="position:fixed; top:20px; right:20px; z-index:9999; min-width:280px;">
    <div style="background:white; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,0.12); padding:16px 20px; display:flex; align-items:center; gap:12px; border-left:4px solid #4ade80;">
        <div style="width:36px;height:36px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-check-circle-fill" style="color:#22c55e;font-size:18px;"></i>
        </div>
        <div>
            <div style="font-weight:700;color:#1e293b;font-size:14px;">Login Berhasil!</div>
            <div style="color:#64748b;font-size:13px;">Selamat datang, <?= htmlspecialchars($_SESSION['flash_login']) ?> 👋</div>
        </div>
        <button onclick="document.getElementById('loginToast').remove()" style="margin-left:auto;background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
    </div>
</div>
<script>setTimeout(()=>{const t=document.getElementById('loginToast');if(t)t.remove();},3000);</script>
<?php unset($_SESSION['flash_login']); endif; ?>

<?php if (!empty($_SESSION['flash_success'])): ?>
<div id="successToast" style="position:fixed; top:20px; right:20px; z-index:9999; min-width:280px;">
    <div style="background:white; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,0.12); padding:16px 20px; display:flex; align-items:center; gap:12px; border-left:4px solid #4ade80;">
        <div style="width:36px;height:36px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-check-circle-fill" style="color:#22c55e;font-size:18px;"></i>
        </div>
        <div>
            <div style="font-weight:700;color:#1e293b;font-size:14px;">Berhasil!</div>
            <div style="color:#64748b;font-size:13px;"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
        </div>
        <button onclick="document.getElementById('successToast').remove()" style="margin-left:auto;background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
    </div>
</div>
<script>setTimeout(()=>{const t=document.getElementById('successToast');if(t)t.remove();},3000);</script>
<?php unset($_SESSION['flash_success']); endif; ?>

<?php if (!empty($_SESSION['flash_error'])): ?>
<div id="errorToast" style="position:fixed; top:20px; right:20px; z-index:9999; min-width:280px;">
    <div style="background:white; border-radius:16px; box-shadow:0 8px 30px rgba(0,0,0,0.12); padding:16px 20px; display:flex; align-items:center; gap:12px; border-left:4px solid #e57373;">
        <div style="width:36px;height:36px;background:#fff5f5;border-radius:10px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-exclamation-circle-fill" style="color:#e57373;font-size:18px;"></i>
        </div>
        <div>
            <div style="font-weight:700;color:#1e293b;font-size:14px;">Gagal!</div>
            <div style="color:#64748b;font-size:13px;"><?= htmlspecialchars($_SESSION['flash_error']) ?></div>
        </div>
        <button onclick="document.getElementById('errorToast').remove()" style="margin-left:auto;background:none;border:none;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
    </div>
</div>
<script>setTimeout(()=>{const t=document.getElementById('errorToast');if(t)t.remove();},3000);</script>
<?php unset($_SESSION['flash_error']); endif; ?>