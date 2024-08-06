<?php

namespace App\Repositories\Interfaces;

use App\Entities\Pet;
use App\Filters\PetFilter;

interface PetRepositoryInterface
{
  public function save(Pet $pet): void;
  
  public function update(Pet $pet): void;

  public function getByPetCode(string $code): Pet;

  public function getByUuid(string $uuid): Pet;
  
  public function list(PetFilter $filter): array;
  
  public function existsPetCode(string $code): bool;     

  public function delete(string $code): void;
}