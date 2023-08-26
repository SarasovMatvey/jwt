<?php

use App\Services\Client\Client;
use GuzzleHttp\Client as GuzzleClient;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

(new Client(new GuzzleClient()))->run();