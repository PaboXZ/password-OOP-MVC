<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\RequiredRule;
use Framework\Validator;

class ValidatorService {

    public function __construct(private Validator $validator){
        $this->validator->addRule('required', new RequiredRule);
    }

    public function validateRegister(){
        $this->validator->validate($_POST, [
            'login' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'passwordConfirm' => ['required'],
            'tos' => ['required']
        ]);
        
    }
}