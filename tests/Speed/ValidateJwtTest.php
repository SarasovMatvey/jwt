<?php

namespace Tests\Speed;

use App\Config\Config;
use App\Jwt\Jwt;
use App\Services\Client\Client;
use App\Services\Client\ResultFormatter;
use Firebase\JWT\JWT as FirebaseJWT;
use GuzzleHttp\Client as GuzzleClient;
use Tests\CustomTestCase;
use App\Helpers\Profiler;

class ValidateJwtTest extends CustomTestCase
{
    public function testValidateJwt(): void
    {
        $ms = (new Profiler)->getExecutionTime(function () {
            ob_start();
            (new Client(
                guzzleClient: new GuzzleClient(),
                resultFormatter: new ResultFormatter(),
                config: new Config(),
                jwt: new Jwt(new FirebaseJWT()),
                profiler: new Profiler()
            ))->run();
            ob_end_clean();
        });

        $this->assertLessThanOrEqual(100, $ms);
    }
}