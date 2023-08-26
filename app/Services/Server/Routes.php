<?php

namespace App\Services\Server;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Routes
{
    /**
     * @return Route[]
     */
    public function getAll(): array
    {
        return [
            new Route('GET', '/v1/foo', function () {
                $headers = getallheaders();
                $jwt = $headers['Authorization'];

                $decodedJwt = (array) JWT::decode($jwt, new Key($_ENV['JWT_PUBLIC_KEY'], 'RS256'));

                if (!isset($decodedJwt['somePayload'])) {
                    http_response_code(401);
                }
            })
        ];
    }
}