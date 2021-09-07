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

    public function getByName(string $name): ?User
    {
        $getUserStatement = $this->pdo->prepare('SELECT * FROM user WHERE name=?');
        $getUserStatement->execute([$name]);
        $result = $getUserStatement->fetch(PDO::FETCH_LAZY);
        if ($result === false) {
            return null;
        } else {
            return new User($result->id, $result->name, $result->email, $result->password);
        }
    }
    public function getById(string $id): ?User //TODO parent class Repository
    {
        $getUserStatement = $this->pdo->prepare('SELECT * FROM user WHERE id=?');
        $getUserStatement->execute([$id]);
        $result = $getUserStatement->fetch(PDO::FETCH_LAZY);
        if ($result === false) {
            return null;
        } else {
            return new User($result->id, $result->name, $result->email, $result->password);
        }
    }

    public function getByEmail(string $email): ?User
    {
        $getUserStatement = $this->pdo->prepare('SELECT * FROM user WHERE email=?');
        $getUserStatement->execute([$email]);
        $result = $getUserStatement->fetch(PDO::FETCH_LAZY);
        if ($result === false) {
            return null;
        } else {
            return new User($result->id, $result->name, $result->email, $result->password);
        }
    }
    public function save(User $user) //TODO move to parent class Repository
    {
        $insertUserStatement = $this->pdo->prepare('INSERT INTO user VALUES(?, ?, ?, ?)');
        $insertUserStatement->execute([$user->getId(), $user->getName(), $user->getEmail(), $user->getPassword()]);
    }

}