<?php

namespace framework;

use ReflectionException;

class App
{
    /**
     * @throws ReflectionException
     */
    public function run(): void
    {
        $routes = Route::getRoutes();
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $route = $routes[$uri] ?? null;

        if ($route && $route['method'] === $method) {
            $controller = new $route['controller'];
            $action = $route['action'];

            $response = $controller->{$action}();
            echo $response->send();
        } else {
            http_response_code(404);
            echo 'Not found';
        }
    }
}