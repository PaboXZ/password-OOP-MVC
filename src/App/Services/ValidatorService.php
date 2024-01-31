<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{EmailRule, RequiredRule, MinRule, MatchRule};
use Framework\Validator;

class ValidatorService {

    private Validator $validator;

    public function __construct(){
        $this->validator = new Validator;

        $this->validator->add('required', new RequiredRule);
        $this->validator->add('min', new MinRule);
        $this->validator->add('match', new MatchRule);
        $this->validator->add('email', new EmailRule);
    }

    public function validateRegister(){
        $this->validator->validate([
            'name' => ['required'],
            'age' => ['required', 'min:20'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
        ], $_POST);
    }
}