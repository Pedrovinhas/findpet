<?php

namespace App\Http\Requests\Pet;

use App\Dtos\Pet\FilterListPet;
use Illuminate\Foundation\Http\FormRequest;

class ListByFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:100',
            'pet_code' => 'sometimes|string|max:50',
            'breed_uuid' => 'sometimes|string|max:100',
            'sex' => 'sometimes|string|max:20',
            'institution_uuid' => 'sometimes|string',
            'limit' => 'sometimes|integer|min:1',
        ];
    }

    public function getFilter(): FilterListPet
    {
        $filter = new FilterListPet();

        $filter->name = $this->query('name');
        $filter->petCode = $this->query('pet_code');
        $filter->breedUuid = $this->query('breed_uuid');
        $filter->sex = $this->query('sex');
        $filter->institutionUuid = $this->query('institution_uuid');
        $filter->limit = $this->query('limit');

        return $filter;
    }
}