<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class EmailRule implements RuleInterface{
    public function process(array $data, string $fieldName, array $params): bool{
        return filter_var($data[$fieldName], FILTER_VALIDATE_EMAIL);
    }
    public function getMessage(array $data, string $fieldName, array $params): string{
        return "Wrong format for email";
    }
}