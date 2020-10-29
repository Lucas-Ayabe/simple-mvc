<?php
namespace Core;

use FastRoute\Dispatcher as Dispatcher;

class App
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function run()
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = isset($_GET['path']) ? "/{$_GET['path']}" : '/';

        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                echo 'NOT FOUND';
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                echo '405 Method Not Allowed';
                break;
            case Dispatcher::FOUND:
                $controller = array_key_first($routeInfo[1]);
                $action = end($routeInfo[1]);

                (new $controller())->$action($routeInfo[2]);
                break;
            default:
                break;
        }
    }
}
