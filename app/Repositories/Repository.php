<?php


namespace app\Repositories;


use PDO;

class Repository
{
    protected $pdo;
    protected $class;
    protected $table;

    public function __construct(PDO $pdo, $class, string $table)
    {
        $this->pdo = $pdo;
        $this->class = $class;
        $this->table = $table;
    }

    public function getBy(string $property, string $value)
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $property . '=?');
        $selectStatement->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $selectStatement->execute([$value]);

        $result = $selectStatement->fetch();
        if ($result === false) {
            return null;
        } else {
            return $result;
        }
    }

    public function save($obj)
    {
        $objAsArray = (array)$obj;
        foreach ($objAsArray as $prop => $value) {
            $last = strripos($prop, "\0");
            $newProp = substr($prop, $last + 1);
            $objAsArray[$newProp] = $value;
            unset($objAsArray[$prop]);
        }
        $props = [];
        $values = [];
        foreach ($objAsArray as $prop => $value) {
            $props[] = $prop;
            if (is_numeric($value)) {
                $values[] = $value;
            } else {
                $values[] = '\'' . $value . '\'';
            }
        }
        $propsString = '(' . implode(', ', $props) . ')';
        $valuesString = '(' . implode(', ', $values) . ')';
        $insertStatement = $this->pdo->prepare(
            'INSERT INTO ' . $this->table . $propsString . ' VALUES' . $valuesString
        );
        $insertStatement->execute();
        return $this->getLastId();
    }

    public function getLastId()
    {
        $selectStatement = $this->pdo->prepare('SELECT MAX(id) FROM ' . $this->table);
        $selectStatement->execute();
        $result = $selectStatement->fetch();
        return $result[0];
    }
}