<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\UserService;
use Framework\TemplateEngine;

class AuthController {

    public function __construct(
        private TemplateEngine $view,
        private UserService $userService
        ){

        
    }

    public function registerView(){
        echo $this->view->render('register.php');
    }

    public function register(){
    }
}