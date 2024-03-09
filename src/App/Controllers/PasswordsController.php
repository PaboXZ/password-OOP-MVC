<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\PasswordsService;
use App\Services\UserService;
use App\Services\ValidatorService;

class PasswordsController {

    public function __construct(
        private PasswordsService $passwordsService,
        private ValidatorService $validatorService
    ){}

    public function addPassword(){
        $this->validatorService->validateAddPassword($_POST);

        $this->passwordsService->add($_POST);

        redirectTo('/');
    }

    public function deletePassword(array $params){
        $this->passwordsService->delete($params['passwordID']);

        redirectTo('/');
    }

    public function regeneratePassword(array $params){
        $this->passwordsService->regeneratePassword($params['passwordID']);
        redirectTo('/');
    }

    public function editPassword(array $params){
        if(!empty($_POST['passwordName'])){
            $this->validatorService->validateEditPasswordName($_POST);
            $this->passwordsService->editPasswordName($_POST['passwordName'], $params['passwordID']);
        }

        if(isset($_POST['password-color-typed'])){
            if(preg_match('#^[a-f0-9]{3}$#', $_POST['password-color-typed'])){
                $this->passwordsService->editPasswordColor($_POST['password-color-typed'], $params['passwordID']);
                redirectTo('/');
            }
        }
        
        if(isset($_POST['password-color'])){
            if(preg_match('#^[a-f0-9]{3}$#', $_POST['password-color'])){
                $this->passwordsService->editPasswordColor($_POST['password-color'], $params['passwordID']);
            }
        }
        redirectTo('/');
    }
}