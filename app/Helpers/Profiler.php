<?php

namespace App\Helpers;

class Profiler
{
    /**
     * Return value is measured in milliseconds
     */
    public static function getExecutionTime(callable $cb): float
    {
        $start = microtime(true);
        $cb();
        return (microtime(true) - $start) * 1000;
    }
}
