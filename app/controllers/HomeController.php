<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\AnimeModel;

class HomeController extends BaseController
{
    public function index()
    {
        $animeModel = new AnimeModel();

        $animes = $animeModel->getAllAnime();

        return $this->view('pages/home/index', [
            'pageTitle' => 'Home Page',
            'animes' => $animes,
        ]);
    }

    public function detail($slug)
    {
        $animeModel = new AnimeModel();

        $anime = $animeModel->getAnimeBySlug($slug);
        $animeEpisodes = $animeModel->getAnimeEpisodes($anime['id']);

        return $this->view('pages/home/detail', [
            'pageTitle' => 'Detail ' . $anime['title'],
            'anime' => $anime,
            'animeEpisodes' => $animeEpisodes,
        ]);
    }

    public function getAnimeGenres($id)
    {
        $animeModel = new AnimeModel();

        return $animeModel->getAnimeGenres($id);
    }

    public function addAnimeToFavorite($animeId)
    {
        session_start();

        $userId = $_SESSION['user_id'];

        var_dump($userId);

        $animeModel = new AnimeModel();

        return $animeModel->addToFavorite($userId, $animeId);
    }
}
