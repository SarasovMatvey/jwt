<?php

namespace App\Helpers;

use Dotenv\Dotenv;

class EnvExtractor
{
    public static function extract(string $envFileDirectory): void {
        Dotenv::createImmutable($envFileDirectory)->load();
    }
}