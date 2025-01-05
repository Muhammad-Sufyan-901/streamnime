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
        header("Location: $url");

        exit;
    }
}
