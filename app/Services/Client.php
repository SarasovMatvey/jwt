<?php

namespace App\Services;

use App\Helpers\Profiler;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;

class Client implements ServiceInterface {
    public function run(): void {
        $token = JWT::encode([
            'somePayload' => 'somePayload'
        ], $_ENV['JWT_PRIVATE_KEY'], 'RS256');

        $client = new GuzzleClient();

        $response = null;
        $executionTime = Profiler::getExecutionTime(function () use (&$response, $client, $token) {
            $response = $client->get('http://server/v1/foo', [
                'headers' => [
                    'Authorization' => $token
                ]
            ]);
        });


        echo '----------------------' . "\n";
        echo 'Execution time: ' . $executionTime . ' milliseconds' . "\n";
        echo 'Status code: ' . $response->getStatusCode() . "\n";
        echo '----------------------' . "\n";
    }
}