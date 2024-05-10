<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require_once __DIR__ . "/$class.php";
});

foreach (glob(__DIR__ . '/routes/*.php') as $route) {
    require_once $route;
}