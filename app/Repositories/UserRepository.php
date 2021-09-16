<?php

namespace app\Repositories;

use app\Models\User;
use PDO;

class UserRepository extends Repository
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, User::class, 'user');
    }

    public function getByName(string $name): ?User
    {
        return $this->getBy('name', $name);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->getBy('email', $email);
    }
    public function getById(string $id): ?User
    {
        return $this->getBy('id', $id);
    }


}