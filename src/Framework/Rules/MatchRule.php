<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MatchRule implements RuleInterface{

    public function process(array $data, string $fieldName, array $params): bool{
        if(!isset($params[0])){
            throw new InvalidArgumentException("Field to match not specified for field: {$fieldName}");
        }
        if(!isset($data[$params[0]]))
            throw new InvalidArgumentException("Field to match ({$data[$params[0]]}) does not exists");

        return $data[$fieldName] === $data[$params[0]];
    }
    public function getMessage(array $data, string $fieldName, array $params): string{
        return "Fields does not match";
    }
}