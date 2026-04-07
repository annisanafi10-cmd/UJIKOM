<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #e3f2fd 0%, #f0f4ff 50%, #fff8e1 100%); min-height: 100vh; font-family: Nunito, sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { background: white; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.08); overflow: hidden; max-width: 1000px; width: 100%; display: flex; }
        .login-left { background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%); padding: 60px 40px; flex: 1; display: flex; flex-direction: column; justify-content: center; color: white; }
        .login-icon { width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 40px; margin-bottom: 30px; }
        .login-right { padding: 60px 50px; flex: 1; }
        .login-title { font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 10px; }
        .login-subtitle { color: #64748b; margin-bottom: 30px; }
        .form-group-custom { margin-bottom: 20px; }
        .form-label-custom { font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .form-input-custom { height: 52px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 12px; padding: 0 18px; font-size: 15px; width: 100%; }
        .form-input-custom:focus { outline: none; border-color: #90caf9; background: white; box-shadow: 0 0 0 4px rgba(144,202,249,0.1); }
        .btn-login { height: 52px; background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%); border: none; border-radius: 12px; color: white; font-weight: 700; font-size: 16px; width: 100%; cursor: pointer; }
        .btn-login:hover { transform: translateY(-2px); }
        .feature-item { display: flex; align-items: center; margin-bottom: 20px; }
        .feature-icon { width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; }
        @media (max-width: 768px) { .login-card { flex-direction: column; } .login-left, .login-right { padding: 40px 30px; } }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="login-left">
            <div class="login-icon"><i class="bi bi-person-plus"></i></div>
            <h2 class="mb-3" style="font-weight:800;font-size:28px;">Buat Akun Baru</h2>
            <p class="mb-4" style="opacity:0.9;font-size:15px;">Daftarkan diri untuk mulai meminjam alat</p>
            <div class="mt-3">
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-person-check"></i></div>
                    <div><strong>Akun Pribadi</strong><p class="mb-0 small" style="opacity:0.8;">Riwayat peminjaman tersimpan per akun</p></div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                    <div><strong>Password Aman</strong><p class="mb-0 small" style="opacity:0.8;">Password dienkripsi sebelum disimpan</p></div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-clock-history"></i></div>
                    <div><strong>Pantau Peminjaman</strong><p class="mb-0 small" style="opacity:0.8;">Lihat status pengajuan secara real-time</p></div>
                </div>
            </div>
        </div>
        <div class="login-right">
            <div class="login-title">Daftar Akun ??</div>
            <p class="login-subtitle">Isi data di bawah untuk membuat akun peminjam</p>
            <?php if (!empty($_SESSION["reg_error"])): ?>
                <div class="alert alert-danger border-0" style="border-radius:12px;">
                    <i class="bi bi-exclamation-circle me-2"></i><?= $_SESSION["reg_error"]; unset($_SESSION["reg_error"]); ?>
                </div>
            <?php endif; ?>
            <form action="index.php?page=registerProcess" method="POST">
                <div class="form-group-custom">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input-custom" required placeholder="Masukkan nama lengkap">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">Username</label>
                    <input type="text" name="username" class="form-input-custom" required placeholder="Buat username unik">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">Password</label>
                    <input type="password" name="password" class="form-input-custom" required placeholder="Buat password">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi" class="form-input-custom" required placeholder="Ulangi password">
                </div>
                <button type="submit" class="btn-login"><i class="bi bi-person-plus me-2"></i>Daftar Sekarang</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">Sudah punya akun? <a href="index.php?page=login" style="color:#64b5f6;font-weight:700;">Login di sini</a></p>
            </div>
            <div class="mt-4 pt-4" style="border-top:1px solid #e2e8f0;">
                <p class="text-center text-muted small mb-0">© 2026 Sistem Peminjaman Alat. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
