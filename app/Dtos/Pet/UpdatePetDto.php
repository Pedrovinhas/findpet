<?php

namespace App\Dtos\Pet;

class UpdatePetDto
{
    public ?PetSitterDto $petSitter = null;

    public function __construct(
        public readonly ?string $petCod = null,
        public readonly ?string $name = null,
        public readonly ?float $weight = null,
        public readonly ?int $age = null,
        public readonly ?bool $neutered = null,
        public readonly ?string $sex = null,
        public readonly ?string $breedUuid = null,
        public readonly ?string $petConditionUuid = null,
    ) {
    }

    public function setPetSitter(?PetSitterDto $dto = null)
    {
        $this->petSitter = $dto;
    }
}