<?php

include __DIR__ . '/app/config.php';
include __DIR__ . '/app/session.php';
include __DIR__ . '/app/function.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = include __DIR__ . '/app/routes/web.php';

if (isset($routes[$uri])) {
    try {
        $path = __DIR__ . "/app/controllers/{$routes[$uri]}";
    
        if (! file_exists($path)) {
            throw new Exception("Controller pada direktori {$path} tidak wujud.");
        }

        include $path;
        die();

    } catch (Throwable $throwable) {
        $error_message = $throwable->getMessage();
        $error_log_path = APP_DIRECTORY . '/storage/log/aplikasi.log';
        echo "Terdapat masalah berlaku: {$error_message}";
        error_log(date(DATE_ATOM) . ' - ' . $error_message . PHP_EOL, 3, $error_log_path);
    }
}

if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $uri)) {
    return false;
}

abort('404');