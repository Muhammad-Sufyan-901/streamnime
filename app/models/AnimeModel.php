<?php

namespace App\Models;

use PDO;
use PDOException;
use Core\BaseModel;

class AnimeModel extends BaseModel
{
    // Mengambil semua data anime
    public function getAllAnime()
    {
        try {
            $sql = "SELECT * FROM animes";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching anime: " . $e->getMessage();

            return null;
        }
    }

    public function getAnimeById($id)
    {
        try {
            $sql = "SELECT * FROM animes WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching anime: " . $e->getMessage();

            return null;
        }
    }

    public function getAnimeBySlug($slug)
    {
        try {
            $sql = "SELECT * FROM animes WHERE slug = :slug";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':slug', $slug);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching anime: " . $e->getMessage();

            return null;
        }
    }

    public function getAnimeGenres($id)
    {
        try {
            $sql = "
                SELECT g.name
                FROM anime_genres ag
                INNER JOIN genres g ON ag.genre_id = g.id
                WHERE ag.anime_id = :id
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_COLUMN); // Mendapatkan list nama genre
        } catch (PDOException $e) {
            echo "Error fetching anime genres: " . $e->getMessage();

            return null;
        }
    }

    public function getAnimeEpisodes($id)
    {
        try {
            $sql = "
                SELECT *
                FROM anime_episodes
                WHERE anime_id = :id
            ";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching anime episodes: " . $e->getMessage();

            return null;
        }
    }

    public function addToFavorite($userId, $animeId)
    {
        try {
            $sql = "INSERT INTO likes (user_id, anime_id) VALUES (:user_id, :anime_id)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':anime_id', $animeId);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding to favorite: " . $e->getMessage();

            return false;
        }
    }
}
