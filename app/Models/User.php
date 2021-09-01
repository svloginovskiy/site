<?php

namespace app\Models;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(int $id, string $name, ?string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
}