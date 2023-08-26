<?php

use App\Services\Server\Routes;
use App\Services\Server\Server;

require_once '../vendor/autoload.php';

(new Server(new Routes()))->run();