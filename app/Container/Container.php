<?php

namespace app\Container;

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
            $parameters = $constructor->getParameters();

            $constructParamsArr = $this->rules[$name]->constructParams;
            $constructParamsArrObj = new \ArrayObject($this->rules[$name]->constructParams);
            $constructParamsIterator = $constructParamsArrObj->getIterator;

            /*foreach ($parameters as $parameter) {
                $paramType = $parameter->getType();
                if (!($paramType instanceof ReflectionNamedType)) {
                    throw new Exception('Non-typed parameter in constructor');
                }
                if (!$paramType->isBuiltin()) {
                    $this->create($paramType);
                } else {
                    if ($constructParamsIterator->valid()) {

                    }
                }
            }*/

            foreach ($parameters as $parameter) {
                $paramName = $parameter->getName();
                if (isset($constructParamsArr[$paramName])) {

                } else {

                }

            }

        } catch (ReflectionException $exception) {
        }
    }

    public function addRules(array $rules)
    {
        $this->rules = $rules + $this->rules;
    }
}
