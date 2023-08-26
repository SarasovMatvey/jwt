<?php

namespace App\Services\Server;

class Route
{
    protected string $method;

    protected string $route;

    /**
     * @var callable
     */
    protected $cb;

    /**
     * @param string $method
     * @param string $route
     * @param callable $cb
     */
    public function __construct(string $method, string $route, callable $cb)
    {
        $this->method = $method;
        $this->route = $route;
        $this->cb = $cb;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return callable
     */
    public function getCb(): callable
    {
        return $this->cb;
    }

    /**
     * @param callable $cb
     */
    public function setCb(callable $cb): void
    {
        $this->cb = $cb;
    }
}
