<?php

namespace App\VOs;

use Core\Identity;

class PetCode implements Identity
{
    private function __construct(
      private string $value
    ) {
        $this->value = $value;
    }

    public static function generate(): Identity
    {
        return new static('');
    }

    public static function create(string $codigo): Identity
    {
        return new static($codigo);
    }

    function getValue()
    {
        return $this->value;
    }

    public function equals($other): bool
    {
        if (!($other instanceof PetCode)) {
            return false;
        }

        return $this->value == $other->getValue();
    }
}
