<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RequiredRule implements RuleInterface {
    public function process(array $data, string $fieldName, array $params): bool{
        return !empty($data[$fieldName]);
    }
    public function getMessage(array $data, string $fieldName, array $params): string{
        return "Field {$fieldName} cannot be empty";
    }
}