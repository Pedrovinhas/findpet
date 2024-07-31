<?php

namespace App\Repositories\Memory;

use App\Dtos\Pet\FilterListPet;
use App\Entities\Pet;
use App\Exceptions\Pet\Entity\PetNotExistsException;
use App\Repositories\Interfaces\PetRepositoryInterface as RepositoryInterface;
use App\VOs\PetSitter;
use Core\DomainValue;

class PetRepository implements RepositoryInterface
{
    private array $pets;

    public function __construct()
    {
        $this->pets = [
          Pet::create(
            'ABC12345',
            'Buddy',
            12.5,
            6,
            true,
            "M",
            DomainValue::create('cd94c54e-91a0-421a-8f4d-c7893ccead5f', 'Street Dog'),
            '6d8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f',
            '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df',
            PetSitter::create(
                'Ronald',
                'Ronald@gmail.com',
            ),
        )
        ];
    }

    public function save(Pet $pet): void
    {
        $this->pets[] = $pet;
    }

    public function update(Pet $pet): void
    {
        /**
         * @var Pet $data
        **/
        foreach ($this->pets as $index => $data) {
            if ($data->getUuid() === $pet->getUuid()) {
                $this->pets[$index] = $pet;
            }
        }
    }

    public function getByPetCode(string $petCode): Pet
    {
        $pet = null;

        /**
         * @var Pet $data
        **/
        foreach ($this->pets as $data) {
            if ($data->getIdentity()->getValue() === $petCode) {
                $pet = $data;
            }
        }
        $this->throwErroIfPetNotExists($pet, 'pet code', $petCode);

        return $pet;
    }

    public function getByUuid(string $uuid): Pet
    {
        $pet = null;

        /**
         * @var Pet $data
        **/
        foreach ($this->pets as $data) {
            if ($data->getUuid() === $uuid) {
                $pet = $data;
            }
        }
        $this->throwErroIfPetNotExists($pet, 'uuid', $uuid);

        return $pet;
    }

    private function throwErroIfPetNotExists(?Pet $pet, string $field = null, string $value = null)
    {
        throw_if(is_null($pet), new PetNotExistsException($field, $value));
    }

    public function list(FilterListPet $filter): array
    {
        return $this->pets;
    }

    public function existsPetCode(string $petCode): bool
    {
        $exists = false;

        /**
         * @var Pet $data
        **/
        foreach ($this->pets as $data) {
            if ($data->getIdentity()->getValue() === $petCode) {
                $exists = true;
            }
        }

        return $exists;
    }

    public function delete(string $petCode): void
    {
        foreach ($this->pets as $index => $data) {
            if ($data->getIdentity()->getValue() === $petCode) {
                unset($this->pets[$index]);
                $this->pets = array_values($this->pets);

                return;
            }
        }

        $this->throwErroIfPetNotExists(null, 'pet code', $petCode);
    }

    public function clear(): void
    {
       $this->pets = [];
    }
}
