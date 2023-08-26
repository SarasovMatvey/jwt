<?php

use App\Services\Server\Routes;
use App\Services\Server\Server;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

(new Server(new Routes()))->run();