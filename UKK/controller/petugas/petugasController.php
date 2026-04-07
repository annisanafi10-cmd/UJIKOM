<?php
require_once __DIR__ . '/../baseController.php';
//arahin ke petugasModel.php
require_once __DIR__ . '/../../model/petugas/petugasModel.php'; 

class PetugasController extends BaseController {
    private $petugasmodel; // Ganti nama variabelnya biar jelas

    public function __construct($pdo) {
        parent::__construct($pdo);
        // panggil class petugasModel
        $this->petugasmodel = new petugasModel($this->db);
    }

    public function index() {
    // Pake petugasmodel (bukan peminnjamanmodel)
    $stats = $this->petugasmodel->getStats(); 
    $pengembalianTerbaru = $this->petugasmodel->getPengembalianTerbaru();
    
    $this->render('petugas/dashboardPetugas', [
        'stats' => $stats,
        'pengembalianTerbaru' => $pengembalianTerbaru
    ]);
}

    public function halamanPersetujuan() {
        // 1. Logika tombol Setuju/Tolak
        if (isset($_GET['setuju'])) {
            $id = $_GET['setuju'];
            
            $stmt = $this->db->prepare("SELECT id_alat, jumlah FROM tb_peminjaman WHERE id_peminjaman = ?");
            $stmt->execute([$id]);
            $pinjam = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($pinjam) {
                $this->db->prepare("UPDATE tb_peminjaman SET status = 'disetujui' WHERE id_peminjaman = ?")->execute([$id]);
                $this->db->prepare("UPDATE tb_alat SET stok = stok - ? WHERE id_alat = ?")->execute([$pinjam['jumlah'], $pinjam['id_alat']]);
                $this->setFlash('flash_success', 'Peminjaman berhasil disetujui.');
            }
            
            header("Location: index.php?page=menyetujui"); exit;
        }
        
        if (isset($_GET['tolak'])) {
            $id = $_GET['tolak'];
            $alasan_tolak = $_GET['alasan_tolak'] ?? 'Tidak ada alasan';
            
            $stmt = $this->db->prepare("UPDATE tb_peminjaman SET status = 'ditolak', alasan_tolak = ? WHERE id_peminjaman = ?");
            $stmt->execute([$alasan_tolak, $id]);
            
            $this->setFlash('flash_success', 'Peminjaman berhasil ditolak.');
            header("Location: index.php?page=menyetujui"); 
            exit;
        }

        // 2. Ambil Statistik untuk Box Atas (Query Langsung ke DB biar Akurat)
        $stats = [
           'totalPerluDisetujui' => $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'menunggu' AND deleted_at IS NULL")->fetchColumn(),
            'totalAktif'          => $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'disetujui'")->fetchColumn(),
            'totalPengembalian'   => $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'kembali'")->fetchColumn(),
        ];

        // 3. Ambil Data Tabel
        $stmt = $this->db->query("SELECT p.id_peminjaman, p.id_user, p.id_alat, p.jumlah, 
                                         p.tgl_pinjam, p.tgl_kembali, p.tgl_dikembalikan, 
                                         p.status, p.catatan, p.alasan_tolak,
                                         u.id_user as user_id, u.nama as nama, a.nama_alat 
                                  FROM tb_peminjaman p 
                                  JOIN tb_user u ON p.id_user = u.id_user 
                                  JOIN tb_alat a ON p.id_alat = a.id_alat 
                                  WHERE p.deleted_at IS NULL
                                  ORDER BY p.id_peminjaman DESC");

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->render('petugas/menyetujui', [
            'data' => $data, 
            'stats' => $stats
        ]);
    }

    public function halamanPengembalian() {
        // Handle tolak pengembalian
        if (isset($_GET['aksi']) && $_GET['aksi'] === 'tolak' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $alasan = $_GET['alasan_tolak_kembali'] ?? 'Tidak ada alasan';
            
            // Update status jadi 'ditolak_kembali' dan simpan alasan
            $stmt = $this->db->prepare("UPDATE tb_peminjaman SET status = 'ditolak_kembali', alasan_tolak_kembali = ? WHERE id_peminjaman = ?");
            $stmt->execute([$alasan, $id]);
            
            $this->setFlash('flash_success', 'Pengembalian berhasil ditolak. Peminjam harus mengembalikan ulang.');
            header("Location: index.php?page=pengembalian");
            exit;
        }
        
        // Mengambil SEMUA data peminjaman untuk ditampilkan
        $stmt = $this->db->query("SELECT p.id_peminjaman, p.id_user, p.id_alat, p.jumlah, 
                                         p.tgl_pinjam, p.tgl_kembali, p.tgl_dikembalikan, 
                                         p.status, p.catatan,
                                         u.nama as nama_user, a.nama_alat 
                                  FROM tb_peminjaman p 
                                  JOIN tb_user u ON p.id_user = u.id_user 
                                  JOIN tb_alat a ON p.id_alat = a.id_alat 
                                  ORDER BY p.tgl_pinjam DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->render('petugas/pengembalian', ['data' => $data]);
    }

    public function prosesKembali() {
        try {
            // Debug log
            error_log("prosesKembali() dipanggil - " . date('Y-m-d H:i:s'));
            error_log("GET params: " . print_r($_GET, true));
            
            if (!isset($_GET['id'])) {
                error_log("Error: ID tidak ada dalam GET params");
                $this->setFlash('flash_error', 'ID peminjaman tidak valid.');
                header("Location: index.php?page=pengembalian");
                exit;
            }
            
            $id_pinjam = (int)$_GET['id'];
            error_log("Processing ID: $id_pinjam");
            
            // Cek apakah peminjaman ada dan statusnya 'disetujui'
            $stmt = $this->db->prepare("SELECT id_alat, jumlah, status FROM tb_peminjaman WHERE id_peminjaman = ?");
            $stmt->execute([$id_pinjam]);
            $pinjam = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$pinjam) {
                error_log("Error: Data peminjaman tidak ditemukan untuk ID $id_pinjam");
                $this->setFlash('flash_error', 'Data peminjaman tidak ditemukan.');
                header("Location: index.php?page=pengembalian");
                exit;
            }
            
            if ($pinjam['status'] !== 'disetujui') {
                error_log("Error: Status peminjaman bukan 'disetujui', status saat ini: " . $pinjam['status']);
                $this->setFlash('flash_error', 'Peminjaman ini tidak bisa dikembalikan. Status: ' . $pinjam['status']);
                header("Location: index.php?page=pengembalian");
                exit;
            }
            
            error_log("Data peminjaman ditemukan: " . print_r($pinjam, true));
            
            // Mulai transaction
            $this->db->beginTransaction();
            
            // Update status dan tanggal kembali
            $sql = "UPDATE tb_peminjaman SET status = 'kembali', tgl_kembali = NOW() WHERE id_peminjaman = ?";
            $stmt = $this->db->prepare($sql);
            
            if (!$stmt->execute([$id_pinjam])) {
                throw new Exception("Gagal update status peminjaman");
            }
            
            // Kembalikan stok alat
            $sql_stok = "UPDATE tb_alat SET stok = stok + ? WHERE id_alat = ?";
            $stmt_stok = $this->db->prepare($sql_stok);
            
            if (!$stmt_stok->execute([$pinjam['jumlah'], $pinjam['id_alat']])) {
                throw new Exception("Gagal update stok alat");
            }
            
            // Commit transaction
            $this->db->commit();
            
            error_log("Pengembalian berhasil untuk ID $id_pinjam");
            $this->setFlash('flash_success', 'Barang berhasil dikembalikan!');
            
        } catch (Exception $e) {
            // Rollback jika ada error
            if ($this->db->inTransaction()) {
                $this->db->rollback();
            }
            
            error_log("Error dalam prosesKembali(): " . $e->getMessage());
            $this->setFlash('flash_error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        header("Location: index.php?page=pengembalian");
        exit;
    }

    public function halamanLaporan() {
        // Tampil HANYA data yang sudah dikembalikan (status = 'kembali')
        $sql = "SELECT p.*, u.nama as nama_user, a.nama_alat 
                FROM tb_peminjaman p 
                JOIN tb_user u ON p.id_user = u.id_user 
                JOIN tb_alat a ON p.id_alat = a.id_alat 
                WHERE p.status = 'kembali'
                ORDER BY p.tgl_kembali DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $laporan = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Handle export CSV
        if (isset($_GET['export']) && $_GET['export'] == 'csv') {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=laporan_peminjaman_' . date('Y-m-d') . '.csv');
            
            $output = fopen('php://output', 'w');
            fputcsv($output, ['ID', 'Peminjam', 'Nama Alat', 'Qty', 'Tgl Pinjam', 'Tgl Kembali', 'Catatan', 'Status']);
            
            foreach ($laporan as $row) {
                fputcsv($output, [
                    $row['id_peminjaman'],
                    $row['nama_user'],
                    $row['nama_alat'],
                    $row['jumlah'],
                    $row['tgl_pinjam'],
                    $row['tgl_kembali'] ?? '-',
                    $row['catatan'] ?? '-',
                    $row['status']
                ]);
            }
            
            fclose($output);
            exit;
        }
        
        $this->render('petugas/laporan', ['laporan' => $laporan]);
    }
}