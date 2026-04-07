<?php
/**
 * USER MODEL
 * Model ini menangani semua operasi database yang berhubungan dengan user
 * Seperti: login, cek password, dll
 */

class UserModel {
    private $db; // Variabel untuk menyimpan koneksi database

    /**
     * CONSTRUCTOR
     * Fungsi yang otomatis jalan saat class dipanggil
     * Menerima koneksi PDO dari luar dan simpan ke $this->db
     */
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * FUNGSI CEK LOGIN
     * Mengecek apakah password yang diinput user cocok dengan role yang ditentukan
     * Password default: peminjam10 (peminjam), admin10 (admin), petugas10 (petugas)
     * 
     * @param string $username - Username yang diinput user (bebas)
     * @param string $password - Password yang diinput user
     * @return array|false - Return data user kalau berhasil, false kalau gagal
     */
    public function cekLogin($username, $password) {
        $inputPass = trim($password);

        // Special case: allow any username for admin/petugas if password matches default
        if ($inputPass === 'admin10') {
            $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE role = 'admin' LIMIT 1");
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) return $user;
        }

        if ($inputPass === 'petugas10') {
            $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE role = 'petugas' LIMIT 1");
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) return $user;
        }

        // Normal login: find user by username
        $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;

        $stored = trim($user['password']);

        // Cek kecocokan password dalam berbagai format yang mungkin ada di database
        if ($stored === $inputPass) return $user;           // plain password
        if ($stored === md5($inputPass)) return $user;      // MD5 hash
        if (password_verify($inputPass, $stored)) return $user; // password_hash

        return false;
    }

    /**
     * FUNGSI UPDATE NAMA USER
     * Update nama user di database
     * 
     * @param int $id_user - ID user
     * @param string $nama - Nama baru
     */
    public function updateNamaUser($id_user, $nama) {
        $sql = "UPDATE tb_user SET nama = ? WHERE id_user = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $id_user]);
    }

    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT id_user FROM tb_user WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    public function register($nama, $username, $password) {
        $sql = "INSERT INTO tb_user (nama, username, password, role) VALUES (?, ?, ?, 'peminjam')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $username, md5($password)]);
    }
}