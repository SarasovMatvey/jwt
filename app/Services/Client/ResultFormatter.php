<?php

namespace App\Services\Client;

class ResultFormatter
{
    public function format(float $executionTime, int $statusCode): string
    {
        $executionTimeColor = match (true) {
            $executionTime <= 100 => "\033[32m",
            default => "\033[31m"
        };
        $statusCodeColor = match (true) {
            $statusCode >= 200 && $statusCode <= 299 => "\033[32m",
            default => "\033[31m"
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
