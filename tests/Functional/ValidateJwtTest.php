<?php

namespace Tests\Functional;

use App\Config\Config;
use App\Helpers\Profiler;
use App\Jwt\Jwt;
use App\Services\Client\Client;
use App\Services\Client\ResultFormatter;
use Firebase\JWT\JWT as FirebaseJWT;
use GuzzleHttp\Client as GuzzleClient;
use Tests\CustomTestCase;

class ValidateJwtTest extends CustomTestCase
{
    public function testValidateJwt(): void
    {
        ob_start();
        (new Client(
            guzzleClient: new GuzzleClient(),
            resultFormatter: new ResultFormatter(),
            config: new Config(),
            jwt: new Jwt(new FirebaseJWT()),
            profiler: new Profiler()
        ))->run();
        $output = ob_get_clean();

        $this->assertMatchesRegularExpression('/.*Execution time: \\033\[32m\d+\.?\d+\\033\[0m milliseconds\nStatus code: \\033\[32m200\\033\[0m.*/', $output);
    }
}