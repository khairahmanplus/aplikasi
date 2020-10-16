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

function url(string $path, array $query_string = [])
{
    if (empty($query_string)) {
        return APP_URL . $path;
    }
    
    return APP_URL . $path . '?' . http_build_query($query_string);
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

function authenticated_user()
{
    if (is_authenticated()) {
        $key = 'web_login_' . session_id();
        $pdo = pdo();
        $sql_statement = 'SELECT * FROM pengguna WHERE id = :id';
        $pdo_statement = $pdo->prepare($sql_statement);
        $pdo_statement->bindValue(':id', $_SESSION[$key]);
        $pdo_statement->execute();
        $user = $pdo_statement->fetch();
        return $user;
    }

    return null;
}