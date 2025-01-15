<?php

// Import BaseRoute
use Core\BaseRoute;

// Deklarasi route

// Home page
BaseRoute::get('/', 'HomeController@index');

// Authentication
BaseRoute::get('/login', 'AuthController@loginView');
BaseRoute::get('/register', 'AuthController@registerView');

// // Detail anime
// BaseRoute::get('/detail/{nama-anime}', 'AnimeController@detail');

// // Login & Register
// BaseRoute::get('/login', 'AuthController@login');
// BaseRoute::post('/login', 'AuthController@doLogin');
// BaseRoute::get('/register', 'AuthController@register');
// BaseRoute::post('/register', 'AuthController@doRegister');

// // Profile page
// BaseRoute::get('/profile/{nama-user}', 'UserController@profile');
