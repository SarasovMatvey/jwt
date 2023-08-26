<?php

namespace App\Services\Client;

use App\Helpers\Profiler;
use App\Services\ServiceInterface;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client implements ServiceInterface
{
    protected GuzzleClient $guzzleClient;

    /**
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function run(): void
    {
        $token = $this->generateJwt();

        $response = null;
        $executionTime = Profiler::getExecutionTime(function () use (&$response, $token) {
            $response = $this->makeRequest($token);
        });

        echo (new ResultFormatter())->format($executionTime, $response->getStatusCode());
    }

    protected function generateJwt(): string
    {
        return JWT::encode([
            'role' => 'admin'
        ], $_ENV['JWT_PRIVATE_KEY'], 'RS256');
    }

    protected function makeRequest($token): ResponseInterface
    {
        return $this->guzzleClient->get('http://server/v1/foo', [
            'headers' => [
                'Authorization' => $token
            ]
        ]);
    }
}
