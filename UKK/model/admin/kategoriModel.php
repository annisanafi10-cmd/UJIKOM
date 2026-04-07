<?php
class KategoriModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getKategori() {
        $sql = "SELECT * FROM tb_kategori WHERE deleted_at IS NULL ORDER BY nama_kategori ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahKategori($nama) {
        try {
            $sql = "INSERT INTO tb_kategori (nama_kategori) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute([$nama])) {
                return true;
            } else {
                $error = $stmt->errorInfo();
                return "Database error: " . $error[2];
            }
        } catch (PDOException $e) {
            return "PDO Exception: " . $e->getMessage();
        }
    }

    public function updateKategori($id, $nama) {
        $sql = "UPDATE tb_kategori SET nama_kategori = ? WHERE id_kategori = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $id]);
    }

    public function hapusKategori($id) {
        $sql = "DELETE FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}