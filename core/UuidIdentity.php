<?php

namespace Core;

final class UuidIdentity implements Identity
{
    private string $value;

    public function __construct(string $uuid)
    {
        $this->value = $uuid;
    }

    public static function generate(): Identity
    {
        return new static('');
    }

    public function getValue()
    {
        return $this->value;
    }

    public function equals($other): bool
    {
        if (!($other instanceof UuidIdentity)) {
            return false;
        }

        return strcmp($this->getValue(), $other->getValue()) === 0;
    }
}