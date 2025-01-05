<?php

namespace App\Controllers;

use Core\BaseController;

class AuthController extends BaseController
{
    public function loginView()
    {
        return $this->view('pages/auth/login', [
            'pageTitle' => 'Login',
            'test' => 'Login'
        ]);
    }

    public function registerView()
    {
        return $this->view('pages/auth/register', [
            'pageTitle' => 'Register',
            'test' => 'Register'
        ]);
    }
}
