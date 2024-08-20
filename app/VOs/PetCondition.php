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

    public static function create(string $identifier): self
    {
        if (PetConditionEnum::isValidValue($identifier)) {
            return new static(PetConditionEnum::from($identifier));
        }

        throw new DomainValueNotExistsException("{$identifier} is not a valid backing value for enum " . PetConditionEnum::class);
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

