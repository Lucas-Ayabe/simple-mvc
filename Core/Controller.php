<?php
namespace Core;

abstract class Controller
{
    public function redirect(string $route)
    {
        header("Location: {$_ENV['BASE_URL']}/$route");
        exit();
    }
}
