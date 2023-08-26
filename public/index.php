<?php

use App\Config\Config;
use App\Services\Server\Controllers\JwtController;
use App\Services\Server\Routes\Routes;
use App\Services\Server\Server;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

(new Server(new Routes(new JwtController(new Config()))))->run();