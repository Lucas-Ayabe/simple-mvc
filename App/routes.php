<?php
namespace Source\routes;

use App\Controllers\MailController;
use App\Controllers\PagesController;
use FastRoute\RouteCollector;

return function (RouteCollector $routes) {
    $routes->get('/', [PagesController::class => "index"]);
    $routes->get('/mail', [MailController::class => "index"]);
    $routes->get('/send', [MailController::class => "send"]);
};
