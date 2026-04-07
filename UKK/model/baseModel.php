<?php
/**
 * BASE MODEL
 * Model dasar yang digunakan sebagai parent class untuk model lainnya
 * Konsep OOP: INHERITANCE (Pewarisan)
 * 
 * Kenapa pakai BaseModel?
 * - Agar tidak perlu menulis ulang kode yang sama di setiap model
 * - Semua model child akan otomatis punya property $db
 * - Prinsip DRY (Don't Repeat Yourself)
 */

class BaseModel {
    // Protected = bisa diakses oleh class ini dan class turunannya
    protected $db; // Variabel untuk menyimpan koneksi database

    /**
     * CONSTRUCTOR
     * Fungsi yang otomatis jalan saat class dipanggil
     * Menerima koneksi PDO dan simpan ke property $db
     */
    public function __construct($pdo) {
        $this->db = $pdo;
    }
}
