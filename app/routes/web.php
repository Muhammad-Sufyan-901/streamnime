<?php

// Import BaseRoute
use Core\BaseRoute;

// Deklarasi route

// Home page
BaseRoute::get('/', 'HomeController@index');

// Detail anime
BaseRoute::get('/detail/:slug', 'HomeController@detail');

// Favorite page
BaseRoute::get('/favorite', 'HomeController@favorite');

// Add to favorite
BaseRoute::post('/add-anime-to-favorite/:animeId', 'HomeController@addAnimeToFavorite');

// Authentication
BaseRoute::get('/login', 'AuthController@loginView');
BaseRoute::get('/register', 'AuthController@registerView');

BaseRoute::post('/login/process', 'AuthController@processLogin');
BaseRoute::post('/register/process', 'AuthController@processRegister');

// Profile page
BaseRoute::protectedRoute('/profile', 'ProfileController@profileView');

// Update profile
BaseRoute::post('/profile/update', 'ProfileController@updateProfile');
