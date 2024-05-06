<?php

namespace framework;

use Attribute;
use ReflectionException;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $path,
        public string $method = 'GET',
    )
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @throws ReflectionException
     */
    public static function getRoutes(): array
    {
        $routes = [];

        $classes = glob(__DIR__ . '/../controllers/*.php');

        foreach ($classes as $class) {
            $class = "controllers\\" . str_replace('.php', '', basename($class));
            $reflection = new \ReflectionClass($class);

            foreach ($reflection->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    $routes[$route->getPath()] = [
                        'method' => $route->getMethod(),
                        'action' => $method->getName(),
                        'controller' => $class,
                    ];
                }
            }
        }

        return $routes;
    }
}