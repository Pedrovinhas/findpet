<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Pet\FilterListPet;
use App\Entities\Pet;

interface PetRepositoryInterface
{
  public function save(Pet $pet): void;
  
  public function update(Pet $pet): void;

  public function getByPetCode(string $code): Pet;

  public function getByUuid(string $uuid): Pet;
  
  public function list(FilterListPet $filter): array;
  
  public function existsPetCode(string $code): bool;     
}