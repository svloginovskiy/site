<?php

namespace app\Models;

class Comment
{
    private $id;
    private $post_id;
    private $user_id;
    private $text;

    public function __construct()
    {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPostId(): string
    {
        return $this->post_id;
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
    public function setPostId(string $post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }
    public function setUserId(string $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

}

