<?php

namespace App\Services\Server\Controllers;

use App\Config\Config;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtController extends BaseController
{
    protected Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function validate(): void
    {
        try {
            $jwt = $this->getHeader('Authorization');
        } catch (Exception $e) {
            http_response_code(401);
            return;
        }

        $decodedJwt = (array) JWT::decode($jwt, new Key($this->config->getJwtPublicKey(), 'RS256'));

        if (!isset($decodedJwt['role']) || $decodedJwt['role'] != 'admin') {
            http_response_code(401);
        }
    }
}
