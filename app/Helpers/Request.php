<?php

namespace App\Helpers;

use Exception;

trait Request
{
    /**
     * @throws Exception
     */
    public static function getHeader(string $header): string
    {
        $headers = getallheaders();

        if (!isset($header, $header)) {
            throw new Exception('No such header');
        }

        return $headers[$header];
    }
}
