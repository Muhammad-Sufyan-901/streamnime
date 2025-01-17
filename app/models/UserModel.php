<?php

namespace App\Models;

use PDO;
use PDOException;
use Core\BaseModel;

class UserModel extends BaseModel
{
    // Menambahkan pengguna baru
    public function createUser($username, $email, $password)
    {
        try {
            $isEmailExists = "SELECT * FROM users WHERE email = :email";

            $stmt = $this->db->prepare($isEmailExists);

            $stmt->bindParam(':email', $email);

            $stmt->execute();

            if ($isEmailExists) {
                return "Email already exists";
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error creating user: " . $e->getMessage();

            return false;
        }
    }

    // Mengambil pengguna berdasarkan ID
    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching user: " . $e->getMessage();

            return null;
        }
    }

    // Memperbarui data pengguna
    public function updateUser($id, $username, $email)
    {
        try {
            $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error updating user: " . $e->getMessage();

            return false;
        }
    }

    // Menghapus pengguna berdasarkan ID
    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting user: " . $e->getMessage();

            return false;
        }
    }

    // Login pengguna
    public function loginUser($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':email', $email);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return null;
        } catch (PDOException $e) {
            echo "Error logging in user: " . $e->getMessage();

            return null;
        }
    }
}
