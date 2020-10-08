<?php

function get_view(string $layout_name, string $view_name, $data = [])
{
    extract($data);

    include APP_DIRECTORY . "/views/layouts/{$layout_name}.view.php";

    die();
}

function url(string $path)
{
    return APP_URL . $path ;
}

function abort(string $view_name)
{    
    include APP_DIRECTORY . "/views/errors/{$view_name}.view.php";

    die();
}