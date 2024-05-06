<?php

require_once __DIR__ . '/../loader.php';

use framework\App;

try {
    (new App())->run();
} catch (ReflectionException $e) {
}