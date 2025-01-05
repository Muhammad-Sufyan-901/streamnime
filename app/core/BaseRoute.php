<?php

namespace Core;

class BaseRoute
{
    private static $routes = [];
    private static $basePath;

    /**
     * Inisialisasi BaseRoute
     */
    public static function init()
    {
        // Include konfigurasi app.php
        require_once __DIR__ . '/../config/app.php';

        global $appConfig; // Ambil $appConfig dari app.php

        // Pastikan konfigurasi 'base_url' ada dan valid
        if (!isset($appConfig['base_url']) || empty($appConfig['base_url'])) {
            throw new \Exception("Configuration 'base_url' in config/app.php not found or empty.");
        }

        $base_url = $appConfig['base_url'];

        // Tentukan base path dari base_url
        $parsedBaseUrl = parse_url($base_url, PHP_URL_PATH);

        // Validasi hasil parsing
        if ($parsedBaseUrl === null) {
            throw new \Exception("Base_url parsing failed. Make sure 'base_url' in config/app.php is valid.");
        }

        self::$basePath = rtrim($parsedBaseUrl, '/');
    }

    /**
     * Method untuk mendefinisikan route dengan method GET
     */
    public static function get($uri, $controllerAction)
    {
        self::$routes[] = ['GET', $uri, $controllerAction];
    }

    /**
     * Method untuk mendefinisikan route dengan method POST
     */
    public static function post($uri, $controllerAction)
    {
        self::$routes[] = ['POST', $uri, $controllerAction];
    }

    /**
     * Method untuk mendefinisikan route dengan method PUT
     */
    public static function put($uri, $controllerAction)
    {
        self::$routes[] = ['PUT', $uri, $controllerAction];
    }

    /**
     * Method untuk mendefinisikan route dengan method DELETE
     */
    public static function delete($uri, $controllerAction)
    {
        self::$routes[] = ['DELETE', $uri, $controllerAction];
    }

    /**
     * Method untuk menjalankan routing untuk menangani request
     */
    public static function dispatch()
    {
        // Hapus base path dari URI request
        $requestUri = str_replace(self::$basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            [$method, $uri, $controllerAction] = $route;

            if ($method === $requestMethod && preg_match(self::convertToRegex($uri), $requestUri, $matches)) {
                [$controllerName, $action] = explode('@', $controllerAction);

                $controllerClass = "\\App\\Controllers\\" . $controllerName;
                $controller = new $controllerClass();

                return call_user_func_array([$controller, $action], array_slice($matches, 1));
            }
        }

        http_response_code(404);

        echo "404 Not Found";
    }

    private static function convertToRegex($uri)
    {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $uri);

        return "#^" . $pattern . "$#";
    }
}

// Inisialisasi BaseRoute
BaseRoute::init();
