<?php

namespace App\Repositories\Memory;

use App\Repositories\Interfaces\BreedRepositoryInterface as RepositoryInterface;
use Core\DomainValue;
use Core\Exceptions\DomainValueNotExistsException;

class BreedRepository implements RepositoryInterface
{
    private array $breeds;

    public function __construct()
    {
        $this->breeds = [
          DomainValue::create('cd94c54e-91a0-421a-8f4d-c7893ccead5f', 'Street Dog'),
          DomainValue::create('20202a5f-c9f4-4061-b41b-66079f8ba21e', 'Beagle'),
          DomainValue::create('34567b89-1234-5678-9101-11213b145678', 'German Shepherd'),
          DomainValue::create('45678c90-2345-6789-0123-22324c256789', 'Golden Retriever'),
          DomainValue::create('56789d01-3456-7890-1234-33435d367890', 'Bulldog')
        ];
    }

    public function list(): array
    {
      return $this->breeds;
    }

    public function getByUuid(string $uuid): DomainValue
    {
        $breed = null;

        /**
         * @var DomainValue $data
        */
        foreach ($this->breeds as $data) {
            if ($data->getKey() === $uuid) {
                $breed = $data;
            }
        }
        $this->throwErrorIfBreedNotExists($breed, 'uuid', $uuid);


        return $breed;
    }

    private function throwErrorIfBreedNotExists(?DomainValue $breed, string $field = null, string $value = null)
    {
        throw_if(is_null($breed), new DomainValueNotExistsException('breed', $field, $value));
    }
}
