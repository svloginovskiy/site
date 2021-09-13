<?php

namespace app\Models;

class Comment
{
    private $id;
    private $postId;
    private $userId;
    private $text;

    public function __construct(int $id, int $postId, int $userId, string $text)
    {
        $this->id = $id;
        $this->text = $text;
        $this->postId = $postId;
        $this->userId = $userId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

}

