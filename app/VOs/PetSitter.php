<?php

namespace App\VOs;

class PetSitter
{
    private function __construct(
        private string $name,
        private string $email,
    ) {
        $this->setName($name);
        $this->setEmail($email);
    }

    public static function create(string $name, string $email)
    {
        return new static($name, $email);
    }

    public static function restore(string $name, string $email)
    {
        return new static($name, $email);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName(string $value)
    {
        if (strlen($value) == 0) {
            throw new \InvalidArgumentException('name do responsável não pode ser vazio');
        }

        $this->name = $value;
    }

    public function setEmail(string $value)
    {
        if (strlen($value) == 0) {
            throw new \InvalidArgumentException('E-mail do responsável não pode ser vazio');
        }

        $this->email = $value;
    }
}