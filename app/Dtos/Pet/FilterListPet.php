<?php

namespace App\Dtos\Pet;

class FilterListPet
{
    public ?string $name;
    public ?string $petCode;
    public ?string $sex;
    public ?string $breedUuid;
    public ?string $institutionUuid;
    public ?string $limit;
}
