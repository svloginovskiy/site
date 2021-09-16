<?php

namespace app\Repositories;

use app\Models\Comment;
use PDO;

class CommentRepository extends Repository
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, Comment::class, 'comment');
    }

    public function getById(string $id)
    {
        return $this->getBy('id', $id);
    }


    public function getCommentsByPostId($post_id)
    {
        $selectStatement = $this->pdo->prepare('SELECT user.name, comment.text FROM user JOIN comment ON user.id = comment.user_id WHERE comment.post_id = ?');
        $selectStatement->execute([$post_id]);
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
