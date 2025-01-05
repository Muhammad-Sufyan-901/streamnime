<?php

// 1. Aktifkan mode debugging (opsional untuk pengembangan)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Include file environment
require_once __DIR__ . '/../app/env.php';

// 3. Include konfigurasi penting
require_once __DIR__ . '/../app/config/app.php';
require_once __DIR__ . '/../app/config/database.php';

// 4. Include Autoload
require_once __DIR__ . '/../app/core/autoload.php';

// 5. Include file routes
require_once __DIR__ . '/../app/routes/web.php';

// 6. Jalankan Routing
use Core\BaseRoute;

try {
    // Inisialisasi BaseRoute
    BaseRoute::init();

    // Jalankan routing untuk menangani request
    BaseRoute::dispatch();
} catch (Exception $e) {
    // Tampilkan error jika terjadi
    http_response_code(500);

    echo "Internal Server Error: " . $e->getMessage();
}
