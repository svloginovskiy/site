<?php

namespace app\Repositories;

use app\Models\Comment;
use PDO;

class CommentRepository
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

    public function save(Comment $comment): int //TODO move to parent class Repository
    {
        $insertStatement = $this->pdo->prepare('INSERT INTO comment VALUES(?, ?, ?, ?)');
        $insertStatement->execute([0, $comment->getPostId(), $comment->getUserId(), $comment->getText()]);
        $countStatement = $this->pdo->prepare('SELECT count(id) FROM comment');
        $countStatement->execute();
        $result = $countStatement->fetch();
        return $result[0];
    }
    public function getCommentsByPostId($post_id)
    {
        $selectStatement = $this->pdo->prepare('SELECT user.name, comment.text FROM user JOIN comment ON user.id = comment.user_id WHERE comment.post_id = ?');
        $selectStatement->execute([$post_id]);
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
