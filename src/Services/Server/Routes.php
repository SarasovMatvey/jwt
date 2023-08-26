<?php

namespace App\Services\Server;

class Routes
{

    /**
     * @return Route[]
     */
    public function getAll(): array
    {
        return [
            new Route('GET', '/v1/foo', function () {})
        ];
    }
}