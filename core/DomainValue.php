<?php

namespace Core;

class DomainValue
{
    private string $uuid;
    private string $nome;

    private function __construct(
        string $uuid,
        string $nome
    ) {
        $this->uuid = $uuid;
        $this->nome = $nome;
    }

    public static function create(string $uuid, $nome)
    {
        return new static($uuid, $nome);
    }

    public function getKey()
    {
        return $this->uuid;
    }

    public function getNome()
    {
        return $this->nome;
    }
}
