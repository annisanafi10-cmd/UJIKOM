<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <style>
        body { background: linear-gradient(135deg, #e3f2fd 0%, #f0f4ff 50%, #fff8e1 100%); min-height: 100vh; font-family: 'Nunito', sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { background: white; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.08); overflow: hidden; max-width: 1000px; width: 100%; display: flex; }
        .login-left { background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%); padding: 60px 40px; flex: 1; display: flex; flex-direction: column; justify-content: center; color: white; position: relative; }
        .login-left::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom; background-size: cover; opacity: 0.3; }
        .login-left-content { position: relative; z-index: 1; }
        .login-icon { width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 40px; margin-bottom: 30px; backdrop-filter: blur(10px); }
        .login-right { padding: 60px 50px; flex: 1; }
        .login-title { font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 10px; }
        .login-subtitle { color: #64748b; margin-bottom: 40px; }
        .form-group-custom { margin-bottom: 24px; }
        .form-label-custom { font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .form-input-custom { height: 52px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 12px; padding: 0 18px; font-size: 15px; transition: all 0.3s ease; width: 100%; }
        .form-input-custom:focus { outline: none; border-color: #90caf9; background: white; box-shadow: 0 0 0 4px rgba(144,202,249,0.1); }
        .btn-login { height: 52px; background: linear-gradient(135deg, #90caf9 0%, #64b5f6 100%); border: none; border-radius: 12px; color: white; font-weight: 700; font-size: 16px; width: 100%; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(144,202,249,0.3); }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(144,202,249,0.4); }
        .feature-item { display: flex; align-items: center; margin-bottom: 20px; }
        .feature-icon { width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; backdrop-filter: blur(10px); }
        @media (max-width: 768px) { .login-card { flex-direction: column; } .login-left, .login-right { padding: 40px 30px; } }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side - Info -->
            <div class="login-left">
                <div class="login-left-content">
                    <div class="login-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h2 class="mb-3" style="font-weight: 800; font-size: 28px;">Sistem Peminjaman Alat</h2>
                    <p class="mb-4" style="opacity: 0.9; font-size: 15px;">Kelola peminjaman alat kantor dengan mudah dan efisien</p>
                    
                    <div class="mt-5">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div>
                                <strong>Mudah Digunakan</strong>
                                <p class="mb-0 small" style="opacity: 0.8;">Interface yang intuitif dan user-friendly</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <strong>Aman & Terpercaya</strong>
                                <p class="mb-0 small" style="opacity: 0.8;">Data Anda terlindungi dengan baik</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <strong>Real-time Tracking</strong>
                                <p class="mb-0 small" style="opacity: 0.8;">Pantau status peminjaman secara langsung</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Form -->
            <div class="login-right">
                <div class="login-title">Selamat Datang! 👋</div>
                <p class="login-subtitle">Silakan masuk ke akun Anda untuk melanjutkan</p>
                
                <form action="index.php?page=loginProcess" method="POST">
                    <?php if (!empty($_SESSION['flash_logout'])): ?>
                        <div class="alert alert-success border-0 mb-3" style="border-radius:12px; background:#f0fdf4; color:#166534;">
                            <i class="bi bi-check-circle me-2"></i>Kamu berhasil logout.
                        </div>
                        <?php unset($_SESSION['flash_logout']); ?>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['reg_success'])): ?>
                        <div class="alert alert-success border-0 mb-3" style="border-radius:12px; background:#f0fdf4; color:#166534;">
                            <i class="bi bi-check-circle me-2"></i><?= $_SESSION['reg_success']; unset($_SESSION['reg_success']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group-custom">
                        <label class="form-label-custom">Username</label>
                        <input type="text" name="username" class="form-input-custom" required placeholder="Masukkan username Anda">
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">Password</label>
                        <input type="password" name="password" class="form-input-custom" required placeholder="Masukkan password Anda">
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
                    </button>
                </form>
                
                <div class="text-center mt-4">
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Hubungi administrator untuk mendapatkan akses
                    </p>
                </div>
                
                <div class="mt-5 pt-4" style="border-top: 1px solid #e2e8f0;">
                    <p class="text-center text-muted small mb-0">
                        © 2026 Sistem Peminjaman Alat. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>