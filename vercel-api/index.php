<?php

// 1. Ambil nama file dan path aslinya
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// 2. Ini triknya: Jika folder publik Laravel memiliki file yang dicari, biarkan return false
if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    return false;
}

// 3. Jembatani request secara utuh ke public/index.php milik Laravel
require_once __DIR__ . '/../public/index.php';
