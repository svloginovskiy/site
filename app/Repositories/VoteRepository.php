<?php

namespace app\Repositories;

use app\Models\Post;
use PDO;

class VoteRepository extends Repository
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo, '', 'vote');
    }


    public function saveVote($post_id, $user_id, $rating) //TODO
    {
        $selectStatement = $this->pdo->prepare('SELECT id FROM vote WHERE user_id = ? && post_id = ?');
        $selectStatement->execute([$user_id, $post_id]);
        $result = $selectStatement->fetch();
        if ($result === false) {
            $insertStatement = $this->pdo->prepare('INSERT INTO vote VALUES(?, ?, ?, ?)');
            $insertStatement->execute([0, $post_id, $user_id, $rating]);
            $res = $insertStatement->fetch();
            if ($res === false) {
                return $post_id . $user_id . $rating;
            }
            return $res;
        } else {
            $updateStatement = $this->pdo->prepare('UPDATE vote SET rating = ? WHERE user_id = ? && post_id = ?');
            $updateStatement->execute([$rating, $user_id, $post_id]);
            return 'update';
        }
    }

    public function getRatingByPostId($post_id)
    {
        $selectStatement = $this->pdo->prepare('SELECT SUM(rating) FROM vote WHERE post_id = ?');
        $selectStatement->execute([$post_id]);
        $result = $selectStatement->fetch();
        if ($result === false || empty($result[0])) {
            return 0;
        } else {
            return $result[0];
        }
    }

    public function getRatingByPostIdAndUserId($post_id, $user_id)
    {
        $selectStatement = $this->pdo->prepare('SELECT rating FROM vote WHERE post_id = ? && user_id = ?');
        $selectStatement->execute([$post_id, $user_id]);
        $result = $selectStatement->fetch();
        if ($result === false || empty($result[0])) {
            return 0;
        } else {
            return $result[0];
        }
    }
}

