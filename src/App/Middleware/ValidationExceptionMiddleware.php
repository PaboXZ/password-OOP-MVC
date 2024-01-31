<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface {

    public function __construct(){
        
    }
    public function process(callable $next){
        try{
            $next();
        }
        catch(ValidationException $e){
            $_SESSION['errors'] = $e->errors;

            $oldData = $_POST;
            $exclusions = ['password', 'confirmPassword'];

            $safeData = array_diff_key($oldData, array_flip($exclusions));

            $_SESSION['oldFormData'] = $safeData;
            $referer = $_SERVER['HTTP_REFERER'];

            redirectTo($referer);
        }
    }
}