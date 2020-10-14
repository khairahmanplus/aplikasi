<?php

function view(string $layout_name, string $view_name, $data = [])
{
    extract($data);

    $layout_path = APP_DIRECTORY . "/views/layouts/{$layout_name}.view.php";

    if (! file_exists($layout_path)) {
        throw new Exception("Layout pada direktori {$layout_path} tidak wujud.");
    }

    include $layout_path;
    
    die();
}

function abort(string $error_page)
{    
    include APP_DIRECTORY . "/views/errors/{$error_page}.view.php";

    die();
}

function url(string $path)
{
    return APP_URL . $path;
}

function pdo()
{
    static $pdo = null;

    if (is_null($pdo)) {
        try {
            $pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (Throwable $throwable) {
            echo $throwable->getMessage();
            die();
        }
    }

    return $pdo;
}

function is_authenticated()
{
    $key = 'web_login_' . session_id();

    return isset($_SESSION[$key]);
}