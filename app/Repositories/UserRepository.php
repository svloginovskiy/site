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

    public function getUsersWithoutPassword() {
        $selectStatement = $this->pdo->prepare('SELECT id, name, email, role FROM user');
        $selectStatement->execute();
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUsersByAmountAndOffset($amount, $offset)
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM user ORDER BY id LIMIT ' . $offset . ', ' . $amount);
        $selectStatement->execute();
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteUser($user_id)
    {
        $deleteStatement = $this->pdo->prepare('DELETE FROM user WHERE id=?');
        $deleteStatement->execute([$user_id]);
        return $deleteStatement->fetch();
    }

    public function changeRole($user_id, $role)
    {
        $updateStatement = $this->pdo->prepare('UPDATE user SET role=? WHERE id=?');
        $updateStatement->execute([$role, $user_id]);
        return $updateStatement->fetch();
    }

    public function getUserByName($username)
    {
        return $this->getBy('name', $username);
    }


}