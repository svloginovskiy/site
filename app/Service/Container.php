<?php

namespace app\Service;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;

class Container
{
    private $instances = [];

    private $rules = [];

    /**
     * @throws Exception
     */
    public function create(string $name)
    {
        if (!empty($this->instances[$name])) {
            return $this->instances[$name];
        }
        try {
            $class = new ReflectionClass($name);
            $constructor = $class->getConstructor();
            $invokedParams = [];
            if (null !== $constructor) {
                $parameters = $constructor->getParameters();

                $constructParamsArr = $this->rules[$name]['constructParams'];

                foreach ($parameters as $parameter) { //TODO move code into another function
                    $paramName = $parameter->getName();
                    if (isset($constructParamsArr[$paramName])) {
                        $invokedParams[] = $constructParamsArr[$paramName];
                    } else {
                        $paramType = $parameter->getType();
                        if (!($paramType instanceof ReflectionNamedType)) {
                            throw new Exception('Non-typed parameter in constructor of ' . $name);
                        } elseif (!$paramType->isBuiltin()) {
                            $invokedParams[] = $this->create($paramType->getName());
                        } else {
                            throw new Exception(
                                'Cannot find an argument for ' . $paramName .
                                ' while creating an instance of ' . $name
                            );
                        }
                    }
                }
            }
            $this->instances[$name] = $class->newInstanceArgs($invokedParams);
        } catch (ReflectionException $exception) {
            error_log($exception->getMessage());
        }
        return $this->instances[$name];
    }

    public function addRules(array $rules)
    {
        $this->rules = $rules + $this->rules;
    }

    public function addRule(string $name, array $rule)
    {
        $this->rules[$name] = $rule;
    }
}
