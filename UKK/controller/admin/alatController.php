<?php
require_once __DIR__ . '/../baseController.php';

class AlatController extends BaseController {
    private $model;

    public function __construct($pdo) {
        parent::__construct($pdo);
        require_once __DIR__ . '/../../model/admin/alatModel.php';
        $this->model = new AlatModel($this->db);
    }

    public function index() {
        $dataAlat = $this->model->getAllAlat();
        
        // Pass $db dan $dataAlat ke view
        $viewPath = __DIR__ . '/../../view/admin/alat.php'; 
        if (file_exists($viewPath)) {
            $db = $this->db;
            extract(['dataAlat' => $dataAlat, 'db' => $db]);
            include $viewPath;
        } else {
            die("File view gak ketemu di: " . $viewPath);
        }
    }

    public function tambah() {
        if (!empty($_POST)) {
            $nama = trim($_POST['nama_alat'] ?? '');
            $stok = (int)($_POST['stok'] ?? 0);
            $id_kategori = (int)($_POST['id_kategori'] ?? 0);

            if (empty($nama)) {
                $this->setFlash('flash_error', 'Nama alat tidak boleh kosong.');
                $this->redirect('index.php?page=alat');
                return;
            }

            if ($id_kategori <= 0) {
                $this->setFlash('flash_error', 'Silakan pilih kategori yang valid.');
                $this->redirect('index.php?page=alat');
                return;
            }

            if ($stok < 0) {
                $this->setFlash('flash_error', 'Stok tidak boleh negatif.');
                $this->redirect('index.php?page=alat');
                return;
            }

            $stmtCek = $this->db->prepare("SELECT id_kategori FROM tb_kategori WHERE id_kategori = ?");
            $stmtCek->execute([$id_kategori]);
            if (!$stmtCek->fetch()) {
                $this->setFlash('flash_error', 'Kategori tidak ditemukan. id_kategori: ' . $id_kategori);
                $this->redirect('index.php?page=alat');
                return;
            }

            $status = ($stok > 0) ? 'tersedia' : 'tidak tersedia';

            try {
                $result = $this->model->simpanAlat($nama, $stok, $id_kategori, $status);
                if ($result) {
                    $this->setFlash('flash_success', 'Alat berhasil ditambahkan: ' . htmlspecialchars($nama));
                } else {
                    $this->setFlash('flash_error', 'Gagal menyimpan alat ke database.');
                }
            } catch (Exception $e) {
                $this->setFlash('flash_error', 'Error: ' . $e->getMessage());
            }
            
            $this->redirect('index.php?page=alat');
        } else {
            $this->redirect('index.php?page=alat');
        }
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $alat = $this->model->getAlatById($id);
            
            // Ambil kategori untuk dropdown di form edit
            $stmtK = $this->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC");
            $kategori = $stmtK->fetchAll(PDO::FETCH_ASSOC);

            if ($alat) {
                // Render file view/admin/edit.php
                $this->render('admin/edit', ['alat' => $alat, 'kategori' => $kategori]);
            } else {
                $this->redirect('index.php?page=alat');
            }
        }
    }

    public function update() {
        if (isset($_POST['update']) || !empty($_POST)) {
            $id = (int)$_POST['id_alat'];
            $nama = trim($_POST['nama_alat']);
            $stok = (int)$_POST['stok'];
            $id_kategori = (int)$_POST['id_kategori'];
            $status = ($stok > 0) ? 'tersedia' : 'tidak tersedia';

            try {
                $sql = "UPDATE tb_alat SET nama_alat = ?, stok = ?, id_kategori = ?, status = ? WHERE id_alat = ?";
                $stmt = $this->db->prepare($sql);
                $result = $stmt->execute([$nama, $stok, $id_kategori, $status, $id]);
                
                if ($result && $stmt->rowCount() > 0) {
                    $this->setFlash('flash_success', 'Data alat berhasil diperbarui! Stok: ' . $stok);
                } else {
                    $this->setFlash('flash_error', 'Gagal memperbarui data! Affected rows: ' . $stmt->rowCount());
                }
            } catch (Exception $e) {
                $this->setFlash('flash_error', 'Error: ' . $e->getMessage());
            }
        } else {
            $this->setFlash('flash_error', 'Data tidak valid!');
        }
        
        $this->redirect('index.php?page=alat');
    }

    public function hapus() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Melakukan soft delete dengan mengisi kolom deleted_at
        $sql = "UPDATE tb_alat SET deleted_at = NOW() WHERE id_alat = ?";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute([$id])) {
            $this->setFlash('flash_success', 'Data alat berhasil dihapus (soft delete).');
        } else {
            $this->setFlash('flash_error', 'Gagal menghapus data.');
        }
    }
    $this->redirect('index.php?page=alat');
}
}