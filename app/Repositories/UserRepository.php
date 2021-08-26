<?php

namespace app\Repositories;

use app\Models\User;
use PDO;

class UserRepository
{
    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByName(string $name): ?User
    {
        $getUserStatement = $this->pdo->prepare("SELECT * FROM user WHERE name=?");
        $getUserStatement->execute([$name]);
        $result = $getUserStatement->fetch(PDO::FETCH_LAZY);
        if ($result === false) {
            return null;
        } else {
            return new User($result->id, $result->name, $result->email, $result->password);
        }
    }
}