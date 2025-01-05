<?php

/** 
 * Konfigurasi database
 */
$databaseConfig = [
    'dsn' => DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
    'username' => DB_USERNAME,
    'password' => DB_PASSWORD,
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
