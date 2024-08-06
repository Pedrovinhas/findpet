<?php

namespace App\Filters;

use Core\Filter;

class PetFilter extends Filter
{
    public ?string $name;
    public ?string $petCode;
    public ?string $sex;
    public ?string $breedUuid;
    public ?string $institutionUuid;
    public ?string $limit;
}
