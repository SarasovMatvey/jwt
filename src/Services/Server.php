<?php

namespace App\Services;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Server implements ServiceInterface {
    public function run(): void {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $r->addRoute('GET', '/v1/foo', function () {
            });
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                echo '404';
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                echo '405';
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $handler($vars);

                break;
        }
    }
}