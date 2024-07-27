<?php

namespace App\Repositories\Memory;

use App\Repositories\Interfaces\PetConditionRepositoryInterface as RepositoryInterface;
use Core\DomainValue;
use Core\Exceptions\DomainValueNotExistsException;

class PetConditionRepository implements RepositoryInterface
{
    private array $petConditions;

    public function __construct()
    {
        $this->petConditions = [
          DomainValue::create('3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df', 'Healthy'),
          DomainValue::create('5c8f2e1a-0c34-4e58-a1ef-5a8a9e8a2ef1', 'Sick'),
          DomainValue::create('8e8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f', 'Rescued'),
          DomainValue::create('5551108a-dd5a-434f-9d2c-bbde4533396b', 'Lost')
        ];
    }

    public function list(): array
    {
      return $this->petConditions;
    }

    public function getByUuid(string $uuid): DomainValue
    {
        $petCondition = null;

        /**
         * @var DomainValue $data
        */
        foreach ($this->petConditions as $data) {
            if ($data->getKey() === $uuid) {
                $petCondition = $data;
            }
        }
        $this->throwErrorIfPetConditionNotExists($petCondition, 'uuid', $uuid);


        return $petCondition;
    }

    private function throwErrorIfPetConditionNotExists(?DomainValue $petCondition, string $field = null, string $value = null)
    {
        throw_if(is_null($petCondition), new DomainValueNotExistsException('Pet Condition', $field, $value));
    }
}
