<?php
require_once __DIR__ . '/../baseController.php';

class AdminController extends BaseController {
    private $model;

    public function __construct($pdo) {
        parent::__construct($pdo);
        require_once __DIR__ . '/../../model/admin/alatModel.php'; // Memanggil model alat
        $this->model = new AlatModel($this->db);
    }

    public function index() {
        $queryAlat = $this->db->query("SELECT COUNT(*) as total FROM tb_alat");
        $totalAlat = $queryAlat->fetch(PDO::FETCH_ASSOC)['total'];

        $queryKategori = $this->db->query("SELECT COUNT(*) as total FROM tb_kategori");
        $totalKategori = $queryKategori->fetch(PDO::FETCH_ASSOC)['total'];

        $queryDipinjam = $this->db->query("SELECT COUNT(*) as total FROM tb_peminjaman WHERE status = 'disetujui'");
        $totalDipinjam = $queryDipinjam->fetch(PDO::FETCH_ASSOC)['total'];

        $queryMenunggu = $this->db->query("SELECT COUNT(*) as total FROM tb_peminjaman WHERE status = 'menunggu'");
        $totalMenunggu = $queryMenunggu->fetch(PDO::FETCH_ASSOC)['total'];

        $queryStokRendah = $this->db->query("SELECT a.*, k.nama_kategori 
                                             FROM tb_alat a 
                                             LEFT JOIN tb_kategori k ON a.id_kategori = k.id_kategori 
                                             WHERE a.stok <= 2 
                                             ORDER BY a.stok ASC 
                                             LIMIT 5");
        $alatStokRendah = $queryStokRendah->fetchAll(PDO::FETCH_ASSOC);

        $this->render('admin/dashboard.php', [
            'totalAlat' => $totalAlat, 
            'totalKategori' => $totalKategori,
            'totalDipinjam' => $totalDipinjam,
            'totalMenunggu' => $totalMenunggu,
            'alatStokRendah' => $alatStokRendah
        ]);
    }

    public function halamanUser() {
        $stmt = $this->db->query("SELECT id_user, nama, username, role FROM tb_user WHERE deleted_at IS NULL ORDER BY id_user ASC");
        $dataUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->render('admin/user', ['dataUser' => $dataUser]);
    }

    public function tambahUser() {
        if (!empty($_POST)) {
            $nama     = trim($_POST['nama'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($nama) || empty($username) || empty($password)) {
                $this->setFlash('flash_error', 'Semua field harus diisi.');
                $this->redirect('index.php?page=user');
                return;
            }

            // Cek username sudah ada
            $cek = $this->db->prepare("SELECT id_user FROM tb_user WHERE username = ?");
            $cek->execute([$username]);
            if ($cek->fetch()) {
                $this->setFlash('flash_error', 'Username sudah dipakai.');
                $this->redirect('index.php?page=user');
                return;
            }

            $stmt = $this->db->prepare("INSERT INTO tb_user (nama, username, password, role) VALUES (?, ?, ?, 'peminjam')");
            if ($stmt->execute([$nama, $username, md5($password)])) {
                $this->setFlash('flash_success', 'User ' . htmlspecialchars($nama) . ' berhasil ditambahkan.');
            } else {
                $this->setFlash('flash_error', 'Gagal menambahkan user.');
            }
        }
        $this->redirect('index.php?page=user');
    }

    public function editUser() {
        if (!empty($_POST)) {
            $id       = (int)$_POST['id_user'];
            $nama     = trim($_POST['nama'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($nama) || empty($username)) {
                $this->setFlash('flash_error', 'Nama dan username tidak boleh kosong.');
                $this->redirect('index.php?page=user');
                return;
            }

            if (!empty($password)) {
                $stmt = $this->db->prepare("UPDATE tb_user SET nama = ?, username = ?, password = ? WHERE id_user = ? AND role = 'peminjam'");
                $result = $stmt->execute([$nama, $username, md5($password), $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE tb_user SET nama = ?, username = ? WHERE id_user = ? AND role = 'peminjam'");
                $result = $stmt->execute([$nama, $username, $id]);
            }

            if ($result) {
                $this->setFlash('flash_success', 'User berhasil diupdate.');
            } else {
                $this->setFlash('flash_error', 'Gagal mengupdate user.');
            }
        }
        $this->redirect('index.php?page=user');
    }

    public function hapusUser() {
        if (isset($_GET['hapus'])) {
            $id = (int)$_GET['hapus'];
            $stmt = $this->db->prepare("UPDATE tb_user SET deleted_at = NOW() WHERE id_user = ? AND role = 'peminjam'");
            if ($stmt->execute([$id])) {
                $this->setFlash('flash_success', 'User berhasil dihapus.');
            } else {
                $this->setFlash('flash_error', 'Gagal menghapus user.');
            }
        }
        $this->redirect('index.php?page=user');
    }
}
