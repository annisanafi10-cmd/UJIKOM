<?php
/**
 * FILE KONEKSI DATABASE
 * File ini berisi konfigurasi koneksi ke database MySQL menggunakan PDO
 * PDO (PHP Data Objects) adalah cara modern dan aman untuk koneksi database
 */

// Konfigurasi Database
$host = 'localhost';                  // Alamat server database (localhost = komputer sendiri)
$dbname = 'db_peminjaman_alat';       // Nama database yang digunakan
$username = 'root';                   // Username MySQL (default XAMPP = root)
$password = '';                       // Password MySQL (default XAMPP = kosong)

try {
    // Membuat koneksi PDO ke database
    // Format: "mysql:host=namahost;dbname=namadatabase"
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode ke EXCEPTION agar error langsung muncul (bagus untuk debugging)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Kalau koneksi gagal, tampilkan pesan error dan hentikan program
    die("Koneksi gagal: " . $e->getMessage());
}
?>