<?php

function view(string $layout_name, string $view_name, $data = [])
{
    extract($data);

    include APP_DIRECTORY . "/views/layouts/{$layout_name}.view.php";

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