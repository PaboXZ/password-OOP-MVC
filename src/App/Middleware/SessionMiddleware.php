<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface {

    public function __construct(){

    }

    public function process(callable $next){

        if(session_status() === PHP_SESSION_ACTIVE)
            throw new SessionException("Session is already active");

        if(headers_sent($filename, $line))
            throw new SessionException("Headers sent file: {$filename}, line {$line}");

        session_start();
        $next();
        session_write_close();
    }
}