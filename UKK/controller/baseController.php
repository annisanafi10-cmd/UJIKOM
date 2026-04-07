<?php

class BaseController {
    protected $db;

    public function __construct($pdo) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->db = $pdo;
    }

    protected function render($view, $data = []) {
        // Mengubah array menjadi variabel (OOP Friendly)
        extract($data);
        
        // Ambil flash message
        $flash_success = $_SESSION['flash_success'] ?? null;
        $flash_error = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);
        
        // Atur path file
        $viewPath = (substr($view, -4) === '.php') ? $view : $view . '.php';
        
        // GUNAKAN require (Tanpa _once) agar data ter-update setiap render
        require __DIR__ . '/../view/' . $viewPath;
    }

    protected function redirect($url) {
        session_write_close();
        header('Location: ' . $url);
        exit;
    }

    protected function setFlash($key, $message) {
        $_SESSION[$key] = $message;
    }
}