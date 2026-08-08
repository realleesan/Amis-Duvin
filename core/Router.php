<?php

namespace Core;

class Router
{
    private static array $routes = [];

    public static function get(string $path, array|callable $handler, array $middlewares = []): void
    {
        self::addRoute('GET', $path, $handler, $middlewares);
    }

    public static function post(string $path, array|callable $handler, array $middlewares = []): void
    {
        self::addRoute('POST', $path, $handler, $middlewares);
    }

    private static function addRoute(string $method, string $path, array|callable $handler, array $middlewares = []): void
    {
        self::$routes[] = [
            'method'      => $method,
            'path'        => rtrim($path, '/') ?: '/',
            'handler'     => $handler,
            'middlewares' => $middlewares
        ];
    }

    public static function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach (self::$routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $uri) {
                // Execute Middlewares first
                if (!empty($route['middlewares'])) {
                    foreach ($route['middlewares'] as $middleware => $params) {
                        if (is_string($middleware) && class_exists($middleware) && method_exists($middleware, 'handle')) {
                            call_user_func([$middleware, 'handle'], (array)$params);
                        } elseif (is_callable($middleware)) {
                            call_user_func($middleware);
                        }
                    }
                }

                $handler = $route['handler'];

                if (is_callable($handler)) {
                    call_user_func($handler);
                    return;
                }

                if (is_array($handler)) {
                    [$controllerClass, $action] = $handler;
                    if (class_exists($controllerClass)) {
                        $controller = new $controllerClass();
                        if (method_exists($controller, $action)) {
                            $controller->$action();
                            return;
                        }
                    }
                }
            }
        }

        // Route not found -> 404
        $errorController = new \App\Controllers\ErrorController();
        $errorController->notFound();
    }
}
