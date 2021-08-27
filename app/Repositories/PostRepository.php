<?php

namespace app\Repositories;

use app\Models\Post;
use PDO;

class PostRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(string $number): Post
    {
        $getPostStatement = $this->pdo->prepare("SELECT * FROM entry WHERE id=?");
        $getPostStatement->execute([$number]);
        $result = $getPostStatement->fetch(PDO::FETCH_LAZY);
        return new Post($result->text);
    }
}
