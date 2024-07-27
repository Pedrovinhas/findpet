<?php

namespace App\Dtos\Pet;

class CreatePetDto
{
    public ?PetSitterDto $petSitter = null;

    public function __construct(
        public readonly string $petCode,
        public readonly string $name,
        public readonly float $weight,
        public readonly int $age,
        public readonly bool $neutered,
        public readonly string $sex,
        public readonly string $breedUuid,
        public readonly string $petConditionUuid,
        public readonly string $institutionUuid,
    ) {
    }

    public function setPetSitter(?PetSitterDto $dto = null)
    {
        $this->petSitter = $dto;
    }
}
