<?php

namespace App\Services\Server;

use App\Services\ServiceInterface;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Server implements ServiceInterface {
    protected string $uri;

    protected string $httpMethod;

    protected Routes $routes;

    public function __construct(Routes $routes)
    {
        $this->routes = $routes;
    }

    public function run(): void {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            $this->linkRoutes($r);
        });

        $this->initHttpMethod();
        $this->initUri();

        $this->handleRouteInfo(
            $dispatcher->dispatch($this->httpMethod, $this->uri)
        );
    }

    protected function handleRouteInfo(array $routeInfo): void {
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $handler($vars);

                break;
        }
    }

    protected function linkRoutes(RouteCollector $r): void {
        foreach ($this->routes->getAll() as $route) {
            $r->addRoute($route->getMethod(), $route->getRoute(), $route->getCb());
        }
    }

    protected function initUri(): void {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $this->uri = rawurldecode($uri);
    }

    protected function initHttpMethod(): void {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
    }
}