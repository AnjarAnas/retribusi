<?php
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

// 2. Bersihkan query string jika ada (?page=1, dll) untuk pengecekan file statis
$path = parse_url($requestUri, PHP_URL_PATH);

// 3. Jika request mengarah ke file fisik yang ada di folder public (js/css/image), langsung return false
if ($path !== '/' && file_exists(__DIR__ . '/../public' . $path)) {
    return false;
}

// 4. TRIK UTAMA: Paksa server membaca SCRIPT_NAME dan SCRIPT_FILENAME seolah-olah berjalan di index.php root
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// 5. Jalankan file index.php asli milik Laravel
require __DIR__ . '/../public/index.php';
