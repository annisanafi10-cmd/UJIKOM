<?php
class petugasModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Statistik untuk dashboard petugas
   public function getStats() {
    // Menghitung yang butuh ACC (status = menunggu)
    $acc = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'menunggu' AND deleted_at IS NULL")->fetchColumn();
    
    // Menghitung yang SEDANG DIPINJAM (status = disetujui)
    $pinjam = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'disetujui'")->fetchColumn();
    
    // Menghitung yang SELESAI/KEMBALI (status = kembali)
    $kembali = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'kembali'")->fetchColumn();
    
    // Menghitung yang terlambat (lebih dari 3 hari dari tgl_pinjam dan status masih 'disetujui')
    $terlambat = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'disetujui' AND DATEDIFF(NOW(), tgl_pinjam) > 3")->fetchColumn();

    return [
        'totalPerluDisetujui' => $acc,
        'totalAktif' => $pinjam,
        'totalPengembalian' => $kembali,
        'totalTerlambat' => $terlambat
    ];
}

 public function getPengembalianTerbaru() {
    $sql = "SELECT p.*, u.nama as nama_user, a.nama_alat 
            FROM tb_peminjaman p
            JOIN tb_user u ON p.id_user = u.id_user
            JOIN tb_alat a ON p.id_alat = a.id_alat
            WHERE p.status = 'kembali' 
            ORDER BY p.id_peminjaman DESC LIMIT 5";
    
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Ambil semua pengajuan peminjaman
    public function getPengajuanPeminjaman() {
        $sql = "SELECT p.*, u.nama as nama_user, a.nama_alat 
                FROM tb_peminjaman p
                JOIN tb_user u ON p.id_user = u.id_user
                JOIN tb_alat a ON p.id_alat = a.id_alat
                WHERE p.status = 'menunggu'
                ORDER BY p.id_peminjaman DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua peminjaman
    public function getAllPersetujuan() {
        $sql = "SELECT p.*, u.nama as nama_user, a.nama_alat 
                FROM tb_peminjaman p
                JOIN tb_user u ON p.id_user = u.id_user
                JOIN tb_alat a ON p.id_alat = a.id_alat
                ORDER BY p.id_peminjaman DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update status peminjaman
    public function updateStatusPersetujuan($id, $status) {
        $sql = "UPDATE tb_peminjaman SET status = ? WHERE id_peminjaman = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function updateStokAlat($id_alat, $stok_baru) {
    $sql = "UPDATE tb_alat SET stok = ? WHERE id_alat = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$stok_baru, $id_alat]);
}

    // Tambahkan ini di dalam class PetugasModel
public function getMonitorPeminjaman() {
    // Kita ambil yang statusnya 'disetujui' (artinya barang dibawa peminjam)
    $sql = "SELECT tp.*, tu.nama as nama_user, tu.email, ta.nama_alat 
            FROM tb_peminjaman AS tp
            JOIN tb_user AS tu ON tp.id_user = tu.id_user
            JOIN tb_alat AS ta ON tp.id_alat = ta.id_alat
            WHERE tp.status = 'disetujui' 
            ORDER BY tp.tgl_pinjam ASC";
    
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function prosesKembali($id) {
    // Update status jadi kembali dan set tanggal dikembalikan hari ini
    $tgl_sekarang = date('Y-m-d H:i:s');
    $sql = "UPDATE tb_peminjaman SET status = 'kembali', tgl_dikembalikan = ? WHERE id_peminjaman = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$tgl_sekarang, $id]);
}
}