<?php

namespace App\Repositories\Interfaces;

use Core\DomainValue;

interface BreedRepositoryInterface
{
    public function getByUuid(string $uuid): DomainValue;

    public function list(): array;
}
