<?php

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->view('pages/home/index', [
            'pageTitle' => 'Home Page',
            'test' => 'Home Page'
        ]);
    }
}
