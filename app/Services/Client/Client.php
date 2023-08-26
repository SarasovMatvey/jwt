<?php

namespace App\Services\Client;

use App\Helpers\Profiler;
use App\Services\ServiceInterface;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;

class Client implements ServiceInterface
{
    public function run(): void
    {
        $token = JWT::encode([
            'role' => 'admin'
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

        echo (new ResultFormatter())->format($executionTime, $response->getStatusCode());
    }
}
