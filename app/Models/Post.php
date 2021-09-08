<?php

namespace app\Models;

class Post
{
    private $id;
    private $text;
    private $title;
    private $userId;
    private $rating;

    public function __construct(int $id, string $text, string $title, int $userId, int $rating)
    {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
        $this->userId = $userId;
        $this->rating = $rating;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }
}
