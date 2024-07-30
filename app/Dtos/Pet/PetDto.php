<?php

namespace App\Dtos\Pet;

use Core\Dto\DomainDto;

class PetDto
{
  public ?PetSitterDto $petSitter = null;

    public function __construct(
        public readonly string $petCode,
        public readonly string $name,
        public readonly float $weight,
        public readonly int $age,
        public readonly bool $neutered,
        public readonly string $sex,
        public readonly DomainDto $breed,
        public readonly DomainDto $petCondition
    ) {
    }

    public function setPetSitter(?PetSitterDto $dto = null)
    {
        $this->petSitter = $dto;
    }
}