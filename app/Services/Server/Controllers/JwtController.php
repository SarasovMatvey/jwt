<?php

namespace App\Services\Server\Controllers;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtController extends BaseController
{
    public function validate(): void
    {
        try {
            $jwt = $this::getHeader('Authorization');
        } catch (Exception $e) {
            http_response_code(401);
            return;
        }

        $decodedJwt = (array) JWT::decode($jwt, new Key($_ENV['JWT_PUBLIC_KEY'], 'RS256'));

        if (!isset($decodedJwt['role']) || $decodedJwt['role'] != 'admin') {
            http_response_code(401);
        }
    }
}
