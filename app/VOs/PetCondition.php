<?php

namespace App\VOs;

use App\Enums\PetCondition as PetConditionEnum;
use Core\Exceptions\DomainValueNotExistsException;

class PetCondition
{
    private PetConditionEnum $value;

    private function __construct(
        PetConditionEnum $value
    ) {
        $this->value = $value;
    }

    public static function create(string $key): self
    {
        if (PetConditionEnum::isValidValue($key)) {
            return new static(PetConditionEnum::from($key));
        }

        throw new DomainValueNotExistsException("{$key} is not a valid backing value for enum " . PetConditionEnum::class);
    }

    public static function restore(string $key)
    {
        return new static(PetConditionEnum::from($key));
    }

    public function getUuid()
    {
        return $this->value->key();
    }

    public function getName()
    {
        return $this->value->name();
    }

    public function isLost()
    {
      return $this->value === PetConditionEnum::RESCUED;
    }
}

