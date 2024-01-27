<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{RequiredRule, MinRule};
use Framework\Validator;

class ValidatorService {

    private Validator $validator;

    public function __construct(){
        $this->validator = new Validator;

        $this->validator->add('required', new RequiredRule);
        $this->validator->add('min', new MinRule);
    }

    public function validateRegister(){
        $this->validator->validate([
            'name' => ['required'],
            'age' => ['required', 'min:20'],
            'email' => ['required'],
            'password' => ['required'],
            'confirmPassword' => ['required'],
        ], $_POST);
    }
}