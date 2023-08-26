<?php

namespace App\Services\Client;

use App\Config\Config;
use App\Helpers\Profiler;
use App\Jwt\Jwt;
use App\Services\ServiceInterface;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client implements ServiceInterface
{
    protected GuzzleClient $guzzleClient;

    protected ResultFormatter $resultFormatter;

    protected Config $config;

    protected Jwt $jwt;

    protected Profiler $profiler;

    /**
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(
        GuzzleClient $guzzleClient,
        ResultFormatter $resultFormatter,
        Config $config,
        Jwt $jwt,
        Profiler $profiler
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->resultFormatter = $resultFormatter;
        $this->config = $config;
        $this->jwt = $jwt;
        $this->profiler = $profiler;
    }

    public function run(): void
    {
        $token = $this->generateJwt();

        $response = null;
        $executionTime = $this->profiler->getExecutionTime(function () use (&$response, $token) {
            $response = $this->makeRequest($token);
        });

        echo $this->resultFormatter->format($executionTime, $response->getStatusCode());
    }

    protected function generateJwt(): string
    {
        return $this->jwt->generateJwt([
            'role' => 'admin'
        ], $this->config->getJwtPrivateKey());
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
