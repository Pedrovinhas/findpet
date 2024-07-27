<?php

namespace App\Services;

use Core\DomainValue;
use Core\Dto\DomainDto;
use App\Repositories\Interfaces\BreedRepositoryInterface as BreedRepo;
use App\Repositories\Interfaces\PetConditionRepositoryInterface as PetConditionRepo;
use App\Services\Contracts\DomainContract as Contract;

class DomainService implements Contract
{
    public function __construct(
        private readonly BreedRepo $breedRepo,
        private readonly PetConditionRepo $petConditionRepo
    ) {
    }

    public function getAllBreeds(): array
    {
        return array_map(
            fn (DomainValue $breed) => new DomainDto($breed->getKey(), $breed->getNome()),
            $this->breedRepo->list()
        );
    }

    public function getAllPetConditions(): array
    {
        return array_map(
            fn (DomainValue $breed) => new DomainDto($breed->getKey(), $breed->getNome()),
            $this->breedRepo->list()
        );
    }
}
