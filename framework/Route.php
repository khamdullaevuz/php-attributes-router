<?php

namespace framework;

use Attribute;
use ReflectionException;

/**
 * @method static void get(string $path, array $action)
 * @method static void post(string $path, array $action)
 * @method static void put(string $path, array $action)
 * @method static void delete(string $path, array $action)
 */
#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Route
{
    protected static array $routes = [];
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

    public static function __callStatic(string $name, array $arguments)
    {
        if(in_array($name, ['get', 'post', 'put', 'delete']) && count($arguments) === 2)
        {
            self::addRoute(strtoupper($name), $arguments[0], $arguments[1]);
        }
    }

    protected static function addRoute(string $method, string $path, array $action): void
    {
        self::$routes[$path] = [
            'method' => $method,
            'action' => $action[0],
            'controller' => $action[1],
        ];
    }

    /**
     * @throws ReflectionException
     */
    public static function getRoutes(): array
    {
        $classes = glob(__DIR__ . '/../controllers/*.php');

        foreach ($classes as $class) {
            $class = "controllers\\" . str_replace('.php', '', basename($class));
            $reflection = new \ReflectionClass($class);

            foreach ($reflection->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();

                    self::$routes[$route->getPath()] = [
                        'method' => $route->getMethod(),
                        'action' => $method->getName(),
                        'controller' => $class,
                    ];
                }
            }
        }

        return self::$routes;
    }
}