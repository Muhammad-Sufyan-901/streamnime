<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../';

    // Periksa apakah namespace diawali dengan prefix
    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Jika file ada, require file
        if (file_exists($file)) {
            require $file;
        }
    } else {
        // Jika namespace bukan 'App\', periksa core classes
        $prefix_core = 'Core\\';
        if (strncmp($prefix_core, $class, strlen($prefix_core)) === 0) {
            $relative_class = substr($class, strlen($prefix_core));
            $file = __DIR__ . '/' . str_replace('\\', '/', $relative_class) . '.php';

            // Jika file ada, require file
            if (file_exists($file)) {
                require $file;
            }
        }
    }
});
