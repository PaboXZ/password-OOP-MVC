<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\UserService;
use App\Services\ValidatorService;
use Framework\Exceptions\ValidatorException;
use Framework\TemplateEngine;

class AuthController {

    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private ValidatorService $validatorService
        ){

        
    }

    public function registerView(){
        echo $this->view->render('register.php');
    }

    public function register(){
        $this->validatorService->validateRegister($_POST);

        $this->userService->register($_POST);

        $this->userService->login($_POST);

        redirectTo('/');
    }

    public function loginView(){
        echo $this->view->render('/login.php');
    }

    public function login(){
        $this->validatorService->validateLogin($_POST);

        $this->userService->login($_POST);

        redirectTo('/');
    }

    public function logout(){
        session_destroy();
        
        redirectTo('/login');
    }
}