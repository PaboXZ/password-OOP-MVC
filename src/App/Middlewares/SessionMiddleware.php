<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Contracts\MiddlewareInterface;

class SessionMiddleware implements MiddlewareInterface {

    public function __construct(){

    }
    
    public function process(callable $next){
        echo "Im here";
        $next();
    }
}