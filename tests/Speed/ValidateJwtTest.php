<?php

namespace Tests\Speed;

use App\Services\Client\Client;
use GuzzleHttp\Client as GuzzleClient;
use Tests\CustomTestCase;
use App\Helpers\Profiler;

class ValidateJwtTest extends CustomTestCase
{
    public function testValidateJwt()
    {
        $ms = Profiler::getExecutionTime(function () {
            ob_start();
            (new Client(new GuzzleClient()))->run();
            ob_end_clean();
        });

        $this->assertLessThanOrEqual(100, $ms);
    }
}