<?php

namespace App\Services\Client;

class ResultFormatter
{
    protected const COLOR_GREEN = '\033[32m';
    protected const COLOR_RED = '\033[31m';

    public function format(float $executionTime, int $statusCode): string
    {
        $executionTimeColor = match (true) {
            $executionTime <= 100 => self::COLOR_GREEN,
            default => self::COLOR_RED
        };
        $statusCodeColor = match (true) {
            $statusCode >= 200 && $statusCode <= 299 => self::COLOR_GREEN,
            default => self::COLOR_RED
        };

        return
<<<EOF

----------------------
Execution time: $executionTimeColor$executionTime\033[0m
Status code: $statusCodeColor$statusCode\033[0m
----------------------


EOF;
    }
}
