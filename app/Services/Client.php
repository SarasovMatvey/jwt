<?php

namespace App\Services;

use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;

class Client implements ServiceInterface {
    public function run(): void {
        $token = JWT::encode([
            'somePayload' => 'somePayload'
        ], $_ENV['JWT_PRIVATE_KEY'], 'RS256');

        $client = new GuzzleClient();

        $response = $client->get('http://server/v1/foo', [
            'headers' => [
                'Authorization' => $token
            ]
        ]);

        echo $response->getStatusCode();
        echo $response->getBody()->getContents();
    }
}