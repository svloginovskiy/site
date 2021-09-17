<?php

namespace app\Models;

class Post
{
    private $id;
    private $text;
    private $title;
    private $user_id;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
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
        return $this->user_id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }
    public function setUserId(string $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }
}
