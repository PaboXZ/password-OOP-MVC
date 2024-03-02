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

        $errors = [];

        if($this->userService->isLoginTaken($_POST['login']))
            $errors['login'][] = "Login already taken";

        if($this->userService->isEmailTaken($_POST['email']))
            $errors['email'][] = "Email already registered";

        if(!empty($errors))
            throw new ValidatorException($errors);

        $this->userService->create($_POST);

        $this->login();

        redirectTo('/');
    }

    public function login(){

    }
}