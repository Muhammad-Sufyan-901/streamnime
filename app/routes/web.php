<?php

// Import BaseRoute
use Core\BaseRoute;

// Deklarasi route

// Home page
BaseRoute::get('/', 'HomeController@index');

// Authentication
BaseRoute::get('/login', 'AuthController@loginView');
BaseRoute::get('/register', 'AuthController@registerView');

BaseRoute::post('/login/process', 'AuthController@processLogin');
BaseRoute::post('/register/process', 'AuthController@processRegister');

// Detail anime
BaseRoute::get('/detail/{nama-anime}', 'AnimeController@detail');

// Profile page
BaseRoute::protectedRoute('/profile', 'ProfileController@profileView');

// Update profile
BaseRoute::post('/profile/update', 'ProfileController@updateProfile');
