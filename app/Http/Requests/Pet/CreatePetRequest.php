<?php

namespace App\Http\Requests\Pet;

use App\Dtos\Pet\CreatePetDto as Dto;
use App\Dtos\Pet\PetSitterDto;
use Illuminate\Foundation\Http\FormRequest;

class CreatePetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'petCode' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'weight' => 'required|numeric|min:0',
            'age' => 'required|integer|min:0',
            'neutered' => 'required|boolean',
            'sex' => 'required|string|max:1',
            'breedUuid' => 'required|uuid',
            'petConditionUuid' => 'required|uuid',
            'petSitter' => 'nullable|array',
            'petSitter.name' => 'required_with:petSitter|string|max:100',
            'petSitter.email' => 'required_with:petSitter|email|max:100',
        ];
    }

    public function getData(): Dto
    {
        $dto = new Dto(
            $this->input('petCode'),
            $this->input('name'),
            $this->input('weight'),
            $this->input('age'),
            $this->input('neutered'),
            $this->input('sex'),
            $this->input('breedUuid'),
            $this->input('petConditionUuid'),
            $this->input('institutionUuid')
        );

        $this->getPetSitter($dto);

        return $dto;
    }

    private function getPetSitter(Dto $petDto): void
    {
      $petDto->setPetSitter(new PetSitterDto(
        $this->input('petSitter.name'),
        $this->input('petSitter.email')
      ));
    }

    public function authorize(): bool
    {
        return true;
    }
}