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

    public function getById(string $number): ?Post
    {
        $getPostStatement = $this->pdo->prepare('SELECT * FROM post WHERE id=?');
        $getPostStatement->execute([$number]);
        $result = $getPostStatement->fetch(PDO::FETCH_LAZY);
        if ($result === false) {
            return null;
        } else {
            return new Post($result->id, $result->text, $result->title, $result->user_id);
        }
    }

    public function save(Post $post): int //TODO move to parent class Repository
    {
        $insertPostStatement = $this->pdo->prepare('INSERT INTO post VALUES(?, ?, ?, ?)');
        $insertPostStatement->execute([0, $post->getText(), $post->getUserId(), $post->getTitle()]);
        return $this->getPostsCount();
    }

    public function getPostsCount(): int
    {
        $selectStatement = $this->pdo->prepare('SELECT COUNT(id) FROM post');
        $selectStatement->execute([]);
        $result = $selectStatement->fetch();
        return $result[0];
    }

    public function getByIdRange(int $from, int $to)
    {
        if ($from > $to) {
            return null;
        }
        $selectStatement = $this->pdo->prepare('SELECT * FROM post WHERE id > ? && id <= ?');
        $selectStatement->execute([$from, $to]);
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
