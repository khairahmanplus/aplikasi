<?php

/**
 * Load configuration, session, and all common functionalities.
 */
include __DIR__ . '/app/config.php';
include __DIR__ . '/app/session.php';
include __DIR__ . '/app/function.php';

/**
 * Start parsing URI path.
 */
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


/**
 * Grab all registered routes.
 */
$routes = include __DIR__ . '/app/routes/web.php';

/**
 * Check if URI path is exists in registered routes.
 */
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

/**
 * Return false for any static files.
 */
if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $uri)) {
    return false;
}

/**
 * Return a 404 view if URI path does not exists.
 */
if (! isset($routes[$uri])) {
    abort(404);
}