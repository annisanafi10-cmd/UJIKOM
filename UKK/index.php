<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
ob_start();
require_once 'koneksi.php'; // Memanggil koneksi ke database

$page = $_GET['page'] ?? 'login';

// 1. Proteksi Halaman: Kalau belum login, tendang ke login page
if (!isset($_SESSION['id_user']) && $page !== 'login' && $page !== 'loginProcess') {
    header("Location: index.php?page=login");
    exit;
}

// 2. Halaman Login (Tanpa Header/Footer)
if ($page === 'login' || $page === 'loginProcess') {
    require_once __DIR__ . '/controller/userController.php';
    $controller = new UserController($pdo);
    if ($page === 'login') {
        $controller->loginPage();
    } else {
        $controller->loginProcess();
    }
    exit;
}

// 3. Layout Dashboard (Header muncul setelah login)
include 'view/layout/header.php'; 
echo '<div class="wrapper d-flex">';
echo '<div class="main-content flex-grow-1 p-4" style="min-height: 100vh; background-color: #f4f6f9;">';
echo '<div class="container-fluid">';

// 4. Router Utama
switch ($page) {
    case 'dashboard':
        if ($_SESSION['role'] === 'petugas') {
            require_once __DIR__ . '/controller/petugas/petugasController.php';
            $petugasControl = new PetugasController($pdo);
            $petugasControl->index();
        } elseif ($_SESSION['role'] === 'admin') {
            require_once __DIR__ . '/controller/admin/adminController.php';
            $adminControl = new AdminController($pdo);
            $adminControl->index();
        } else {
            // Role peminjam lari ke sini
            require_once __DIR__ . '/controller/peminjam/peminjamanController.php';
            $peminjamControl = new PeminjamanController($pdo);
            $peminjamControl->index();
        }
        break;

    case 'user':
        if ($_SESSION['role'] !== 'admin') { header("Location: index.php?page=dashboard"); exit; }
        require_once __DIR__ . '/controller/admin/adminController.php';
        $controller = new AdminController($pdo);
        $aksi = $_GET['aksi'] ?? '';
        if (isset($_GET['hapus'])) {
            $controller->hapusUser();
        } elseif ($aksi === 'edit' && !empty($_POST)) {
            $controller->editUser();
        } elseif ($aksi === 'tambah' && !empty($_POST)) {
            $controller->tambahUser();
        } else {
            $controller->halamanUser();
        }
        break;

    case 'alat':
        if ($_SESSION['role'] === 'peminjam') { header("Location: index.php?page=dashboard"); exit; }
        require_once __DIR__ . '/controller/admin/alatController.php';
        $controller = new AlatController($pdo);
        
        $aksi = $_GET['aksi'] ?? '';

        if (isset($_POST['update']) || ($aksi === 'update' && !empty($_POST))) {
            $controller->update();
        } elseif ($aksi === 'update') { 
            $controller->update(); 
        } elseif ($aksi === 'hapus') { 
            $controller->hapus(); 
        } elseif ($aksi === 'tambah') { 
            $controller->tambah(); 
        } elseif ($aksi === 'edit') { 
            $controller->edit(); 
        } else { 
            $controller->index(); 
        }
        break;

    case 'kategori':
        if ($_SESSION['role'] === 'peminjam') { header("Location: index.php?page=dashboard"); exit; }
        require_once __DIR__ . '/controller/admin/kategoriController.php';
        $controller = new KategoriController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formAction = $_POST['form_action'] ?? null;
            if ($formAction === 'tambah' || isset($_POST['submit'])) {
                $controller->tambah();
            } elseif ($formAction === 'edit' || isset($_POST['update'])) {
                $controller->edit();
            } else {
                $controller->index();
            }
        } elseif (isset($_GET['hapus'])) {
            $controller->hapus();
        } else {
            $controller->index();
        }
        break;

    case 'peminjaman':
        if ($_SESSION['role'] === 'admin') {
            require_once __DIR__ . '/controller/peminjam/peminjamanController.php';
            $controller = new PeminjamanController($pdo);
            
            if (isset($_GET['hapus'])) { 
                $controller->hapus(); 
            } elseif (isset($_POST['submit'])) { 
                $controller->tambah(); 
            } else { 
                $controller->index(); 
            }
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'menyetujui':
        if ($_SESSION['role'] === 'petugas') {
            require_once __DIR__ . '/controller/petugas/petugasController.php';
            $petugasControl = new PetugasController($pdo);
            $petugasControl->halamanPersetujuan();
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

        case 'daftar_alat':
        if ($_SESSION['role'] === 'peminjam') {
            require_once __DIR__ . '/controller/peminjam/peminjamanController.php';
            $controller = new PeminjamanController($pdo);
            $controller->daftarAlat(); // Manggil fungsi katalog card
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'ajukan_pinjam':
        if ($_SESSION['role'] === 'peminjam') {
            require_once __DIR__ . '/controller/peminjam/peminjamanController.php';
            $controller = new PeminjamanController($pdo);
            
            // Handle batalkan pengajuan
            if (isset($_GET['batal'])) {
                $controller->batal();
            } elseif (!empty($_POST)) {
                $controller->tambah();
            } else {
                $controller->form();
            }
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'pengembalian':
        if ($_SESSION['role'] === 'petugas' || $_SESSION['role'] === 'admin') {
            require_once __DIR__ . '/controller/petugas/petugasController.php';
            $petugasControl = new PetugasController($pdo);
            
            // Tambahkan logika aksi di sini
            $aksi = $_GET['aksi'] ?? '';
            if ($aksi === 'proses') {
                $petugasControl->prosesKembali(); 
            } else {
                $petugasControl->halamanPengembalian(); 
            }
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'laporan':
        if ($_SESSION['role'] === 'petugas' || $_SESSION['role'] === 'admin') {
            require_once __DIR__ . '/controller/petugas/petugasController.php';
            $petugasControl = new PetugasController($pdo);
            $petugasControl->halamanLaporan(); 
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'log':
        if ($_SESSION['role'] === 'admin') {
            $stmt = $pdo->query("SELECT * FROM log_aktivitas ORDER BY waktu DESC");
            $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            require_once __DIR__ . '/view/admin/aktivitas.php';
        } else {
            header("Location: index.php?page=dashboard");
        }
        break;

    case 'logout':
        require_once __DIR__ . '/controller/userController.php';
        $controller = new UserController($pdo);
        $controller->logout();
        break;

    default:
        header("Location: index.php?page=dashboard");
        break;
}

echo '</div>'; // Tutup container-fluid
echo '</div>'; // Tutup main-content
echo '</div>'; // Tutup wrapper

include 'view/layout/footer.php';
?>