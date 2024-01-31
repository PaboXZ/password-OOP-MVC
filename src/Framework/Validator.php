<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator {
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule){
        $this->rules[$alias] = $rule;
    }

    public function validate(array $instructions, array $data){
        $errors = [];

        foreach($instructions as $fieldName => $rules){
            foreach($rules as $rule){
            
            $params = [];
            if(str_contains($rule, ':')){
                [$rule, $params] = explode(':', $rule);
                $params = explode(',',$params);
            }
                if($this->rules[$rule]->process($data, $fieldName, $params))
                    continue;

                $errors[$fieldName][] = $this->rules[$rule]->getMessage($data, $fieldName, $params);

            }
        }

        if(!empty($errors))
            throw new ValidationException($errors);
    }
}