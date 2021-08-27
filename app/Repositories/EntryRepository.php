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
    }

    public function getEntryById(string $number): Entry
    {
        $getEntryStatement = $this->pdo->prepare("SELECT * FROM entry WHERE id=?");
        $getEntryStatement->execute([$number]);
        $result = $getEntryStatement->fetch(PDO::FETCH_LAZY);
        return new Entry($result->text);
    }
}
