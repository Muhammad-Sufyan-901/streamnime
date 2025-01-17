<?php

namespace Core;

class BaseController
{
    /** 
     * Method untuk mengeksekusi file view
     */
    protected function view($view, $data = [])
    {
        extract($data);

        include __DIR__ . "/../views/$view.php";
    }

    /** 
     * Method untuk melakukan redirect
     */
    protected function redirect($url)
    {
        global $appConfig;

        $base_url = rtrim($appConfig['base_url'], '/'); // Pastikan base_url tanpa trailing slash
        $path = ltrim($url, '/'); // Pastikan path tanpa leading slash

        header("Location: " . $base_url . '/' . $path);

        exit;
    }
}
