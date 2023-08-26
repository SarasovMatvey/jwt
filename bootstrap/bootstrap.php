<?php

use App\Helpers\EnvExtractor;

require_once __DIR__ . '/../vendor/autoload.php';

EnvExtractor::extract(__DIR__ . '/../config/');