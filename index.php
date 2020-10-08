<?php

include __DIR__ . 'app/config.php';
include __DIR__ . 'app/session.php';
include __DIR__ . 'app/function.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = include __DIR__ . '/app/routes/web.php';

if (isset($routes[$uri])) {
    $path = __DIR__ . "/app/controllers/{$routes[$uri]}";
    
    if (file_exists($path)) {
        include $path;
        die();
    }
}

if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $uri)) {
    return false;
}

abort('404');