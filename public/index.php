<?php
use Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$routes = require __DIR__ . "/../App/routes.php";

$app = new App(FastRoute\simpleDispatcher($routes));
$app->run();
