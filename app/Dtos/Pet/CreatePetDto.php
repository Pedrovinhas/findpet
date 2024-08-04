<?php

namespace App\Dtos\Pet;

class CreatePetDto
{
    public ?PetSitterDto $petSitter = null;

    public function __construct(
        public string $petCode,
        public string $name,
        public float $weight,
        public int $age,
        public bool $neutered,
        public string $sex,
        public string $breedUuid,
        public string $petConditionUuid,
        public string $institutionUuid,
    ) {
    }

    public function setPetSitter(?PetSitterDto $dto = null)
    {
        $this->petSitter = $dto;
    }
}
