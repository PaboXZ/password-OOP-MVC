<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MinRule implements RuleInterface {
    public function process(array $data, string $fieldName, array $params): bool{
        if(empty($params[0]))
            throw new InvalidArgumentException("Missing parameter in MinRule for {$fieldName}");

        return (int) $data[$fieldName] >= (int) $params[0];
    }
    public function getMessage(array $data, string $fieldName, array $params): string{
        return "{$fieldName} must be {$params[0]} or higher";
    }
}