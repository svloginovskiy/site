<?php

namespace app\Repositories;

use app\Models\Entry;
use PDO;

class EntryRepository
{
    private $pdo;
    private $getEntryStatement;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $getEntryStatement = $pdo->prepare("SELECT * FROM entry WHERE id = ?");
    }

    public function getEntryById(int $number): Entry
    {
        $this->getEntryStatement->execute($number);
        $result = $this->getEntryStatement->fetch(PDO::FETCH_LAZY);
        return new Entry($result->text);
    }
}
