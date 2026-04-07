<?php
class AlatModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAllAlat() {
        // Ambil semua kolom termasuk status, JOIN dengan kategori
        // Filter hanya yang belum dihapus (deleted_at IS NULL)
        $sql = "SELECT tb_alat.*, tb_kategori.nama_kategori 
                FROM tb_alat 
                LEFT JOIN tb_kategori ON tb_alat.id_kategori = tb_kategori.id_kategori 
                WHERE tb_alat.deleted_at IS NULL
                ORDER BY tb_alat.id_alat DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlatById($id) {
        $sql = "SELECT * FROM tb_alat WHERE id_alat = ? AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAlat($id, $nama, $stok, $id_kategori, $status) {
    try {
        // Pastikan $status cuma berisi 'tersedia' atau 'tidak tersedia' sesuai ENUM di DB
        $sql = "UPDATE tb_alat SET 
                nama_alat = ?, 
                stok = ?, 
                id_kategori = ?, 
                status = ? 
                WHERE id_alat = ?";
        
        $stmt = $this->db->prepare($sql);
        // Kita paksa execute dan kembalikan hasilnya
        return $stmt->execute([$nama, $stok, $id_kategori, $status, $id]);
    } catch (PDOException $e) {
        return false;
    }
}

    public function simpanAlat($nama, $stok, $id_kategori, $status) {
        try {
            $sql = "INSERT INTO tb_alat (nama_alat, stok, id_kategori, status) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nama, $stok, $id_kategori, $status]);
        } catch (PDOException $e) {
            throw new Exception("Gagal simpan alat: " . $e->getMessage());
        }
    }

    public function hapusAlatJadiHabis($id) {
        // Logika soft delete: stok jadi 0 dan status jadi tidak tersedia
        try {
            $sql = "UPDATE tb_alat SET stok = 0, status = 'tidak tersedia' WHERE id_alat = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error hapusAlat: " . $e->getMessage());
            return false;
        }
    }
}