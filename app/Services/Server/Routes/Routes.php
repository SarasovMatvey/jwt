<?php

namespace App\Services\Server\Routes;

use App\Services\Server\Controllers\JwtController;

class Routes
{
    protected JwtController $jwtController;

    /**
     * @param JwtController $jwtController
     */
    public function __construct(JwtController $jwtController)
    {
        $this->jwtController = $jwtController;
    }

    /**
     * @return Route[]
     */
    public function getAll(): array
    {
        return [
            new Route('GET', '/v1/foo', fn () => $this->jwtController->validate())
        ];
    }
}
