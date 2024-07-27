<?php

namespace App\Services\Contracts;

use Core\Dto\DomainDto;
use Illuminate\Support\Collection;

interface DomainContract
{
  /**@return DomainDto[] */
  public function getAllBreeds(): array;

  /**@return DomainDto[] */
  public function getAllPetConditions(): array;
}
