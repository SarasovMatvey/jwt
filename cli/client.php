<?php

use App\Services\Client;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

(new Client())->run();