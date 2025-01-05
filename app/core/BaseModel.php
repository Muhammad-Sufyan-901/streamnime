<?php

namespace Core;

use PDO;

class BaseModel
{
    protected $db;

    /**
     * Method untuk inisialisasi koneksi ke database
     */
    public function __construct()
    {
        include __DIR__ . '/../config/database.php';

        try {
            $this->db = new PDO(
                $databaseConfig['dsn'],
                $databaseConfig['username'],
                $databaseConfig['password'],
                $databaseConfig['options'],
            );
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Method untuk menjalankan query SQL
     */
    protected function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);

        return $stmt;
    }
}
