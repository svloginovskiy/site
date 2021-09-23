<?php

namespace app\Models;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $description;
    private $avatar;

    public function __construct()
    {
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
    public function getRole()
    {
        return $this->role;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }
    public function setRole(string $role)
    {
        $this->role = $role;
        return $this;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}