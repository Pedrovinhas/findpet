<?php

namespace App\Repositories\Interfaces;

use Core\DomainValue;

interface PetConditionRepositoryInterface
{
    public function getByUuid(string $uuid): DomainValue;

    public function list(): array;
}
