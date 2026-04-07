<?php
/**
 * USER CONTROLLER
 * Controller ini menangani semua proses yang berhubungan dengan user
 * Seperti: login, logout, dan pencatatan log aktivitas
 */

class UserController {
    private $model; // Variabel untuk menyimpan UserModel
    private $db;    // Variabel untuk menyimpan koneksi database (untuk query log)

    /**
     * CONSTRUCTOR
     * Fungsi yang otomatis jalan saat class dipanggil
     */
    public function __construct($pdo) {
        $this->db = $pdo; // Simpan koneksi database
        
        // Panggil file UserModel
        require_once __DIR__ . '/../model/userModel.php';
        
        // Buat instance UserModel dan simpan ke $this->model
        $this->model = new UserModel($pdo);
    }

    /**
     * FUNGSI AJUKAN PROSES (Legacy - jarang dipakai)
     * Fungsi ini untuk proses pengajuan peminjaman
     */
    public function ajukanProses() {
        // 1. Panggil Model Peminjaman
        require_once __DIR__ . '/../model/peminjam/peminnjamanModel.php';
        $peminjamanModel = new peminnjamanModel($this->db);

        // Cek apakah request method adalah POST (form disubmit)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_user    = $_SESSION['id_user'];      // ID user yang login
            $id_alat    = $_POST['id_alat'];         // ID alat yang dipinjam
            $jumlah     = $_POST['jumlah'];          // Jumlah yang dipinjam
            $tgl_pinjam = $_POST['tgl_pinjam'];      // Tanggal pinjam
            $catatan    = $_POST['catatan'];         // Catatan peminjaman

            // 2. Simpan ke database
            $simpan = $peminjamanModel->ajukanPeminjaman($id_user, $id_alat, $jumlah, $tgl_pinjam, $catatan);

            if ($simpan) {
                // 3. Catat ke Log Aktivitas
                $this->catatLog($id_user, $_SESSION['nama'], "Mengajukan peminjaman alat ID: " . $id_alat);
                
                // 4. Redirect ke Dashboard
                header("Location: index.php?page=dashboard");
                exit;
            } else {
                echo "Aduh, gagal nyimpen data ke database!";
            }
        }
    }

    /**
     * FUNGSI CATAT LOG (PRIVATE)
     * Fungsi internal untuk mencatat aktivitas user ke database
     * Private = hanya bisa dipanggil dari dalam class ini
     * 
     * @param int $id - ID user
     * @param string $nama - Nama user
     * @param string $aksi - Deskripsi aktivitas yang dilakukan
     */
    private function catatLog($id, $nama, $aksi) {
        // Query untuk insert log ke tabel log_aktivitas
        $sql = "INSERT INTO log_aktivitas (id_user, nama_user, aktivitas) VALUES (?, ?, ?)";
        
        // Prepare dan execute query
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $nama, $aksi]);
    }

    /**
     * FUNGSI LOGIN PAGE
     * Menampilkan halaman form login
     */
    public function loginPage() {
        require_once 'view/login.php'; // Panggil file view login
    }

    /**
     * FUNGSI LOGIN PROCESS
     * Memproses data login yang disubmit user
     */
    public function loginProcess() {
        // Cek apakah request method adalah POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form login dan bersihkan spasi tambahan
            $username = trim($_POST['username'] ?? '');
            $pass     = trim($_POST['password'] ?? '');
            
            // Panggil fungsi cekLogin dari UserModel
            $user = $this->model->cekLogin($username, $pass);

            // Jika login berhasil (user ditemukan dan password cocok)
            if ($user) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['role']    = $user['role'];

                // Kalau login admin/petugas lewat password default, pakai username input sebagai nama tampilan
                if (($user['role'] === 'admin' && $pass === 'admin10') || ($user['role'] === 'petugas' && $pass === 'petugas10')) {
                    $_SESSION['nama'] = $username;
                    $_SESSION['flash_login'] = $username;
                    $this->catatLog($user['id_user'], $username, "Login: Berhasil masuk ke sistem");
                } else {
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['flash_login'] = $user['nama'];
                    $this->catatLog($user['id_user'], $user['nama'], "Login: Berhasil masuk ke sistem");
                }

                header("Location: index.php?page=dashboard");
                exit;
            } else {
                echo "<script>alert('Username atau password salah!'); history.back();</script>";
            }
        }
    }

    /**
     * FUNGSI LOGOUT
     * Menghapus session dan mengembalikan user ke halaman login
     */
    public function logout() {
        if (isset($_SESSION['id_user'])) {
            $this->catatLog($_SESSION['id_user'], $_SESSION['nama'], "Logout: Berhasil keluar dari sistem");
        }
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['flash_logout'] = true;
        header("Location: index.php?page=login");
        exit;
    }

    public function registerPage() {
        require_once 'view/register.php';
    }

    public function registerProcess() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama     = trim($_POST['nama'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $konfirm  = trim($_POST['konfirmasi'] ?? '');

            if (empty($nama) || empty($username) || empty($password)) {
                $_SESSION['reg_error'] = 'Semua field harus diisi.';
                header("Location: index.php?page=register");
                exit;
            }

            if ($password !== $konfirm) {
                $_SESSION['reg_error'] = 'Password dan konfirmasi tidak cocok.';
                header("Location: index.php?page=register");
                exit;
            }

            if ($this->model->usernameExists($username)) {
                $_SESSION['reg_error'] = 'Username sudah dipakai, coba yang lain.';
                header("Location: index.php?page=register");
                exit;
            }

            if ($this->model->register($nama, $username, $password)) {
                $_SESSION['reg_success'] = 'Akun berhasil dibuat! Silakan login.';
                header("Location: index.php?page=login");
            } else {
                $_SESSION['reg_error'] = 'Gagal membuat akun, coba lagi.';
                header("Location: index.php?page=register");
            }
            exit;
        }
    }
}