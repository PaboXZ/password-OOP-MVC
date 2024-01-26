<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass;
use Framework\Exceptions\ContainerException;
use ReflectionNamedType;

class Container {

    private array $definitions = [];
    private array $resolved = [];

    public function add(array $newDefinitions){
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve($className){

        $reflectionClass = new ReflectionClass($className);

        if(!$reflectionClass->isInstantiable())
            throw new ContainerException("Cannot instantiate class {$className}. Not instantiable");

        $constructor = $reflectionClass->getConstructor();
        $parameters = $constructor->getParameters();

        if(count($parameters) === 0)
            return new $className;

        $depedencies = [];

        foreach($parameters as $parameter){
            $name = $parameter->getName();
            $type = $parameter->getType();

            if(!$type)
                throw new ContainerException("Cannot instantiate class {$className}, parameter {$name} is missing type");

            if(!$type instanceof ReflectionNamedType)
                throw new ContainerException("Invalid parameter type, class: {$className}, parameter: {$name}");

            $depedencies[] = $this->get($type->getName());
        }

        return $reflectionClass->newInstanceArgs($depedencies);
    }

    private function get($className){
        if(!array_key_exists($className, $this->definitions))
            throw new ContainerException("Class {$className} is not registered in container class");

        if(array_key_exists($className, $this->resolved))
            return $this->resolved[$className];

        $factory = $this->definitions[$className];

        $depedency = $factory();
        $this->resolved[$className] = $depedency;

        return $depedency;
    }
}