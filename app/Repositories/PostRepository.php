<?php

namespace app\Repositories;

use app\Models\Post;
use PDO;

class PostRepository extends Repository
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, Post::class, 'post');
    }


    public function getById(string $value)
    {
        return $this->getBy('id', $value);
    }

    public function getPostsCount(): int
    {
        $selectStatement = $this->pdo->prepare('SELECT COUNT(id) FROM post');
        $selectStatement->execute([]);
        $result = $selectStatement->fetch();
        return $result[0];
    }

    public function getPostsByAmountAndOffset($amount, $offset)
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM post ORDER BY id DESC LIMIT ' . $offset . ', ' . $amount);
        $selectStatement->execute();
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostsSortedByRating($amount, $offset)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT SUM(COALESCE(vote.rating, 0)) as rating, post.id, post.text, post.user_id, post.title FROM vote RIGHT JOIN post ON vote.post_id=post.id GROUP BY post.id ORDER BY rating DESC LIMIT ' . $offset . ', ' . $amount
        );
        $selectStatement->execute();
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostsByTitlePattern($pattern)
    {
        return $this->getByPattern('title', $pattern);
    }

    public function getPostsByTextPattern($pattern)
    {
        return $this->getByPattern('text', $pattern);
    }

    public function getPostsByPattern($pattern, $desc = true)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT * FROM ' . $this->table . ' WHERE title LIKE ? OR text LIKE ? ORDER BY id ' . ($desc ? 'DESC' : 'ASC')
        );
        $pattern = '%' . $pattern . '%';
        $selectStatement->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $selectStatement->execute([$pattern, $pattern]);
        return $selectStatement->fetchAll();
    }

    public function getPostsAndCreators()
    {
        $selectStatement = $this->pdo->prepare('SELECT post.id, post.text, post.title, user.name AS user FROM post JOIN user ON post.user_id=user.id');
        $selectStatement->execute();
        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deletePost($post_id)
    {
        $deleteStatement = $this->pdo->prepare('DELETE FROM post WHERE id=?');
        $deleteStatement->execute([$post_id]);
        return $deleteStatement->fetch();
    }
}
