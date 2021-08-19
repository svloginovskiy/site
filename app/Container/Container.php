<?php

namespace app\Container;

class Container
{
    private $instances = [];

    private $rules = [];

    public function create(string $name)
    {
        if (!empty($this->instances[$name])) {
            return $this->instances[$name];
        }
        try {
            $class = new \ReflectionClass($name);
            $constructor = $class->getConstructor();
            $parameters = $constructor->getParameters();

            $constructParamsArrObj = $this->rules[$name]->constructParams;
            $constructParamsIterator = $constructParamsArrObj->getIterator;

            foreach ($parameters as $parameter) {
                $paramClass = $parameter->getType();
                if ($paramClass->isUserDefined()) {
                    $this->create($paramClass);
                } else {

                }
            }
        } catch (\ReflectionException $exception) {
        }
    }

    public function addRules(array $rules)
    {
        $this->rules = $rules + $this->rules;
    }
}
