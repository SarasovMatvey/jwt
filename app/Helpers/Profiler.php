<?php

namespace App\Helpers;

class Profiler
{
    /**
     * Return value is measured in milliseconds
     *
     * @param callable $cb
     */
    public static function getExecutionTime(callable $cb): int {
        $start = microtime(true);
        $cb();
        return (microtime(true) - $start) * 1000;
    }
}