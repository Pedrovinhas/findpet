<?php

namespace App\Services\Contracts;

use App\Dtos\Pet\CreatePetDto;
use App\Dtos\Pet\FilterListPet;
use App\Dtos\Pet\UpdatePetDto;
use App\Entities\Pet;

interface PetContract
{
  public function create(CreatePetDto $dto): void;

  public function getByPetCode(string $petCode): Pet;

  public function update(string $uuid, UpdatePetDto $dto): Pet;

  public function listByFilters(FilterListPet $filter): array;
}