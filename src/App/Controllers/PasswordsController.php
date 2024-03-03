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
}