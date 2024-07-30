<?php

namespace App\Dtos\Pet;

use Core\Filter;

class FilterListPet extends Filter
{
    public ?string $name;
    public ?string $petCode;
    public ?string $sex;
    public ?string $breedUuid;
    public ?string $institutionUuid;
}
