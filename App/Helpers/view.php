<?php

use Core\View;

function view(string $path, array $data)
{
    $view = new View();

    foreach ($data as $var => $value) {
        $view->$var = $value;
    }

    return $view->render($path);
}
