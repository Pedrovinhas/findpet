<?php

namespace Core;

class DomainValue
{
    private function __construct(
        private readonly string $uuid,
        private readonly string $name
    ) {}

    public static function create(string $uuid, $name)
    {
        return new static($uuid, $name);
    }

    public function getKey()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }
}
