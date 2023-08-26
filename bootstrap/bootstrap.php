<?php

use App\Helpers\EnvExtractor;

require_once __DIR__ . '/../vendor/autoload.php';

(new EnvExtractor)->extract(__DIR__ . '/../config/');