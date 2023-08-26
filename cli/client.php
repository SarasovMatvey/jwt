<?php

use App\Config\Config;
use App\Helpers\Profiler;
use App\Jwt\Jwt;
use App\Services\Client\Client;
use App\Services\Client\ResultFormatter;
use GuzzleHttp\Client as GuzzleClient;
use Firebase\JWT\JWT as FirebaseJWT;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

(new Client(
    guzzleClient: new GuzzleClient(),
    resultFormatter: new ResultFormatter(),
    config: new Config(),
    jwt: new Jwt(new FirebaseJWT()),
    profiler: new Profiler()
))->run();