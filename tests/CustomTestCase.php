<?php

namespace Tests;

use App\Helpers\EnvExtractor;
use PHPUnit\Framework\TestCase;
use Throwable;

class CustomTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        EnvExtractor::extract(__DIR__.'/../config/');
    }
}