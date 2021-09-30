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
        $selectStatement = $this->pdo->prepare(
            'SELECT post.id, post.text, post.title, user.name AS user FROM post JOIN user ON post.user_id=user.id ORDER BY post.id DESC'
        );
        $selectStatement->execute();
        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePost($post_id)
    {
        $deleteStatement = $this->pdo->prepare('DELETE FROM post WHERE id=?');
        $deleteStatement->execute([$post_id]);
        return $deleteStatement->fetch();
    }

    public function getPostsByUsername($username)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT SUM(COALESCE(vote.rating, 0)) AS rating, post.id, post.text, post.title FROM vote RIGHT JOIN post ON post.id = vote.post_id JOIN user ON post.user_id=user.id WHERE user.name=? GROUP BY post.id ORDER BY id DESC;'
        );
        $selectStatement->execute([$username]);
        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostsByCategoryName($category)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT SUM(COALESCE(vote.rating, 0)) AS rating, post.id, post.text, post.title FROM vote RIGHT JOIN post ON post.id = vote.post_id JOIN category ON post.category_id=category.id WHERE category.name=? GROUP BY post.id ORDER BY id DESC'
        );
        $selectStatement->execute([$category]);
        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryOfPost($id)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT category.name FROM category JOIN post ON post.category_id=category.id WHERE post.id=?'
        );
        $selectStatement->execute([$id]);
        return ($selectStatement->fetch())[0];
    }

    public function changeCategory($post_id, $category)
    {
        $selectStatement = $this->pdo->prepare('SELECT id FROM category WHERE name=?');
        $selectStatement->execute([$category]);
        $categoryId = ($selectStatement->fetch())[0];
        $updateStatement = $this->pdo->prepare('UPDATE post SET category_id=? WHERE id=?');
        $updateStatement->execute([$categoryId, $post_id]);
        return $updateStatement->fetch();
    }

    public function getPostsCountByCategory($category)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT COUNT(post.id) FROM post JOIN category ON post.category_id=category.id WHERE category.name=?'
        );
        $selectStatement->execute([$category]);
        $result = $selectStatement->fetch();
        return $result[0];
    }

    public function getPostsByCategoryNameWithAmountAndOffset($category, $amount, $offset)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT  SUM(COALESCE(vote.rating, 0)) AS rating, post.* FROM vote RIGHT JOIN post ON post.id=vote.post_id JOIN category ON post.category_id=category.id WHERE category.name = ? GROUP BY post.id ORDER BY id DESC LIMIT ' . $offset . ', ' . $amount
        );
        $selectStatement->execute([$category]);
        $result = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostsAndCreatorsWithAmountAndOffset(int $amount, int $offset)
    {
        $selectStatement = $this->pdo->prepare(
            'SELECT post.id, post.text, post.title, user.name AS user FROM post JOIN user ON post.user_id=user.id ORDER BY post.id DESC LIMIT ' . $offset . ', ' . $amount
        );
        $selectStatement->execute();
        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePost(array $post)
    {
        $selectStatement = $this->pdo->prepare('SELECT id FROM category WHERE name=?');
        $selectStatement->execute([$post['category']]);
        $categoryId = $selectStatement->fetch()[0];
        $updateStatement = $this->pdo->prepare('UPDATE post SET title=?, text=?, category_id=? where id=?');
        $updateStatement->execute([$post['title'], $post['text'], $categoryId, $post['id']]);
    }
}
