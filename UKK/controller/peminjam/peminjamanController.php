<?php
require_once __DIR__ . '/../baseController.php';
require_once __DIR__ . '/../../model/peminjam/peminnjamanModel.php'; 
require_once __DIR__ . '/../../model/admin/alatModel.php';
require_once __DIR__ . '/../../model/baseModel.php';

class PeminjamanController extends BaseController {
    private $peminnjamanmodel;
    private $alatmodel;

    public function __construct($pdo) {
        parent::__construct($pdo);
        // Fix case-sensitive class name
        $this->peminnjamanmodel = new peminnjamanModel($this->db);
        $this->alatmodel = new AlatModel($this->db);
    }

    // HALAMAN DASHBOARD PEMINJAM (Ringkasan)
    public function index() {
        $id_user = $_SESSION['id_user'];
        $role = $_SESSION['role'];
        
        // Ambil data spesifik user yang login
        $myPeminjaman = $this->peminnjamanmodel->getPeminjamanByUser($id_user);

        if ($role === 'admin') {
            $dataAll = $this->peminnjamanmodel->getAllPeminjaman();
            $this->render('admin/peminjaman', ['data' => $dataAll]);
        } elseif ($role === 'petugas') {
            $dataAll = $this->peminnjamanmodel->getAllPeminjaman();
            $this->render('petugas/peminjamanPetugas', ['data' => $dataAll]);
        } else {
            // Render dashboard bagus pake variabel 'myPeminjaman'
            $this->render('peminjam/dashboardPeminjam', [
                'myPeminjaman' => $myPeminjaman
            ]);
        }
    }

    // HALAMAN DAFTAR ALAT (Tampilan Katalog Card)
    public function daftarAlat() {
        // Ambil data dari alatModel
        $daftarAlat = $this->alatmodel->getAllAlat();

        // Render ke file daftar_alat.php di folder peminjam
        $this->render('peminjam/daftar_alat', [
            'daftarAlat' => $daftarAlat
        ]);
    }

    public function tambah() {
        if (!empty($_POST) && isset($_POST['id_alat'])) {
            try {
                $id_user = $_SESSION['id_user']; 
                $id_alat = $_POST['id_alat'];
                $jumlah  = (int) $_POST['jumlah'];
                $tgl_pinjam = $_POST['tgl_pinjam'];
                $tgl_kembali = $_POST['tgl_kembali'] ?? null;
                $catatan = $_POST['catatan'] ?? '';
                
                // Validasi input
                if (empty($id_alat) || $jumlah <= 0) {
                    $this->setFlash('flash_error', 'Data tidak lengkap.');
                    header('Location: index.php?page=ajukan_pinjam');
                    exit;
                }

                $alat = $this->alatmodel->getAlatById($id_alat);
                
                if (!$alat) {
                    $this->setFlash('flash_error', 'Alat tidak ditemukan.');
                    header('Location: index.php?page=ajukan_pinjam');
                    exit;
                }
                
                if ($jumlah > (int)$alat['stok']) {
                    $this->setFlash('flash_error', 'Jumlah melebihi stok tersedia (' . $alat['stok'] . ' unit).');
                    header('Location: index.php?page=ajukan_pinjam');
                    exit;
                }

                // Simpan ke database tanpa nama_peminjam dan kategori_peminjam
                $result = $this->peminnjamanmodel->tambahPeminjaman($id_user, $id_alat, $jumlah, $tgl_pinjam, $tgl_kembali, $catatan);
                
                if ($result) {
                    $this->setFlash('flash_success', 'Berhasil dikirim.');
                    header('Location: index.php?page=dashboard');
                    exit;
                } else {
                    $this->setFlash('flash_error', 'Gagal menyimpan.');
                    header('Location: index.php?page=ajukan_pinjam');
                    exit;
                }
            } catch (Exception $e) {
                $this->setFlash('flash_error', 'Terjadi kesalahan: ' . $e->getMessage());
                header('Location: index.php?page=ajukan_pinjam');
                exit;
            }
        }
    }

    public function form() {
    // Tangkep id dari URL (id_alat)
    $id_alat = $_GET['id_alat'] ?? null; 
    
    $dataAlat = $this->alatmodel->getAllAlat();
    
    // Cari data alat spesifik kalau user ngeklik dari katalog
    $selectedAlat = null;
    if ($id_alat) {
        $selectedAlat = $this->alatmodel->getAlatById($id_alat);
    }
    
    $myPeminjaman = $this->peminnjamanmodel->getPeminjamanByUser($_SESSION['id_user']);

    $this->render('peminjam/form', [
        'dataAlat' => $dataAlat, 
        'selectedAlat' => $selectedAlat, 
        'myPeminjaman' => $myPeminjaman
    ]);
}

    public function batal() {
        if (isset($_GET['batal'])) {
            $id_peminjaman = $_GET['batal'];
            $id_user = $_SESSION['id_user'];
            
            // Cek apakah peminjaman ini milik user yang login dan statusnya masih menunggu
            $stmt = $this->db->prepare("SELECT * FROM tb_peminjaman WHERE id_peminjaman = ? AND id_user = ? AND status = 'menunggu' AND deleted_at IS NULL");
            $stmt->execute([$id_peminjaman, $id_user]);
            $peminjaman = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($peminjaman) {
                // Soft delete - set deleted_at
                $stmt = $this->db->prepare("UPDATE tb_peminjaman SET deleted_at = NOW() WHERE id_peminjaman = ?");
                if ($stmt->execute([$id_peminjaman])) {
                    $this->setFlash('flash_success', 'Pengajuan berhasil dibatalkan.');
                } else {
                    $this->setFlash('flash_error', 'Gagal membatalkan pengajuan.');
                }
            } else {
                $this->setFlash('flash_error', 'Pengajuan tidak ditemukan atau tidak bisa dibatalkan.');
            }
        }
        $this->redirect('index.php?page=ajukan_pinjam');
    }
}