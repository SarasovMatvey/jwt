<?php

namespace App\Jwt;

use Firebase\JWT\JWT as FirebaseJWT;

class Jwt
{
    protected FirebaseJWT $jwt;

    /**
     * @param FirebaseJWT $jwt
     */
    public function __construct(FirebaseJWT $jwt)
    {
        $this->jwt = $jwt;
    }

    public function generateJwt(array $payload, string $privateKey): string
    {
        return $this->jwt::encode($payload, $privateKey, 'RS256');
    }
}
