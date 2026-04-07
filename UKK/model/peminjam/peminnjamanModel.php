<?php
class peminnjamanModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ambil data peminjaman milik user ini (untuk Dashboard Peminjam)
    public function getPeminjamanByUser($id_user) {
        $sql = "SELECT p.*, u.nama as nama_user, a.nama_alat 
                FROM tb_peminjaman p
                JOIN tb_user u ON p.id_user = u.id_user
                JOIN tb_alat a ON p.id_alat = a.id_alat
                WHERE p.id_user = :id_user AND p.deleted_at IS NULL
                ORDER BY p.id_peminjaman DESC";
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function getAllPeminjaman() {
        $sql = "SELECT p.*, u.nama as nama_user, u.role, a.nama_alat 
                FROM tb_peminjaman p
                JOIN tb_user u ON p.id_user = u.id_user
                JOIN tb_alat a ON p.id_alat = a.id_alat
                WHERE p.deleted_at IS NULL
                ORDER BY p.id_peminjaman DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPeminjamanMenungguPersetujuan() {
        // Sama, hapus u.kelas di sini juga
        $sql = "SELECT p.*, u.nama as nama_user, u.role, a.nama_alat 
                FROM tb_peminjaman p
                JOIN tb_user u ON p.id_user = u.id_user
                JOIN tb_alat a ON p.id_alat = a.id_alat
                WHERE p.status = 'menunggu'
                ORDER BY p.id_peminjaman DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi Update Status (Ini yang bikin tombol Setuju/Tolak jalan)
    public function setujuiPeminjaman($id) {
        $sql = "UPDATE tb_peminjaman SET status = 'disetujui' WHERE id_peminjaman = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function tolakPeminjaman($id) {
        $sql = "UPDATE tb_peminjaman SET status = 'ditolak' WHERE id_peminjaman = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Tambahkan ini di model/peminjam/peminnjamanModel.php
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

    // Ambil data untuk box statistik Petugas
    public function getStatistikPetugas() {
        $stats = [];
        $stmt = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'disetujui'");
        $stats['totalAktif'] = $stmt->fetchColumn();

        $stmt = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'menunggu'");
        $stats['totalPerluDisetujui'] = $stmt->fetchColumn();

        $stmt = $this->db->query("SELECT COUNT(*) FROM tb_peminjaman WHERE status = 'kembali'");
        $stats['totalPengembalian'] = $stmt->fetchColumn();

        return $stats;
    }

    // --- FUNGSI TAMBAHAN LAINNYA ---
    public function tambahPeminjaman($id_user, $id_alat, $jumlah, $tgl_pinjam, $tgl_kembali, $catatan = '') {
        $sql = "INSERT INTO tb_peminjaman (id_user, id_alat, jumlah, tgl_pinjam, tgl_kembali, catatan, status) VALUES (?, ?, ?, ?, ?, ?, 'menunggu')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_user, $id_alat, $jumlah, $tgl_pinjam, $tgl_kembali, $catatan]);
    }

    public function ajukanPeminjaman($id_user, $id_alat, $jumlah, $tgl_pinjam, $catatan) {
    // Lu ganti 'keperluan' jadi 'catatan' supaya sesuai sama database lu
    $sql = "INSERT INTO tb_peminjaman (id_user, id_alat, jumlah, tgl_pinjam, catatan, status) 
            VALUES (?, ?, ?, ?, ?, 'menunggu')";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id_user, $id_alat, $jumlah, $tgl_pinjam, $catatan]);
}

    public function hapusPeminjaman($id) {
        $sql = "DELETE FROM tb_peminjaman WHERE id_peminjaman = ?";
        $query = $this->db->prepare($sql); 
        return $query->execute([$id]);
    }
}