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
        if ($parsedBaseUrl === false || $parsedBaseUrl === '' || $parsedBaseUrl === null) {
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
        global $appConfig;

        // Hapus base path dari URI request
        $requestUri = str_replace(self::$basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            [$method, $uri, $controllerAction, $protected] = array_pad($route, 4, false);

            if ($method === $requestMethod && preg_match(self::convertToRegex($uri), $requestUri, $matches)) {
                if ($protected) {
                    session_start();
                    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
                        $base_url = rtrim($appConfig['base_url'], '/');
                        header("Location: " . $base_url . '/login');
                        exit();
                    }
                }

                // Extract named parameters from matches
                $params = [];
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }

                [$controllerName, $action] = explode('@', $controllerAction);
                $controllerClass = "\\App\\Controllers\\" . $controllerName;
                $controller = new $controllerClass();
                return call_user_func_array([$controller, $action], $params);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    /**
     * Method untuk mengubah URI menjadi regex
     */
    private static function convertToRegex($uri)
    {
        // Convert :parameter to named regex groups
        $pattern = preg_replace('/\:([a-zA-Z0-9_]+)/', '(?P<\1>[a-zA-Z0-9_-]+)', $uri);

        return "#^" . $pattern . "$#";
    }

    /**
     * Method untuk mendefinisikan route yang dilindungi (protected route)
     */
    public static function protectedRoute($uri, $controllerAction)
    {
        self::$routes[] = ['GET', $uri, $controllerAction, true];
    }
}

// Inisialisasi BaseRoute
BaseRoute::init();
