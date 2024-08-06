<?php

namespace App\Adapters;

use App\Dtos\Pet\FilterListPet;
use App\Filters\PetFilter;

class PetFilterAdapter
{
    public static function convert(FilterListPet $filterListPet): PetFilter
    {
        $petFilter = new PetFilter();

        if (isset($filterListPet->name)) {
            $petFilter->name = $filterListPet->name;
        }

        if (isset($filterListPet->petCode)) {
            $petFilter->petCode = $filterListPet->petCode;
        }

        if (isset($filterListPet->sex)) {
            $petFilter->sex = $filterListPet->sex;
        }

        if (isset($filterListPet->breedUuid)) {
            $petFilter->breedUuid = $filterListPet->breedUuid;
        }

        if (isset($filterListPet->institutionUuid)) {
            $petFilter->institutionUuid = $filterListPet->institutionUuid;
        }

        if (isset($filterListPet->limit)) {
            $petFilter->limit = $filterListPet->limit;
        }

        return $petFilter;
    }
}