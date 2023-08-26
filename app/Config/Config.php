<?php

namespace App\Config;

class Config
{
    public function getJwtPublicKey(): string
    {
        return $_ENV['JWT_PUBLIC_KEY'];
    }

    public function getJwtPrivateKey(): string
    {
        return $_ENV['JWT_PRIVATE_KEY'];
    }
}
