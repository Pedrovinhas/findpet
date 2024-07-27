<?php

namespace Tests\Fakes\Entities;

use Illuminate\Foundation\Testing\WithFaker;

class CreatePet
{
    use WithFaker;

    public string $petCode;
    public string $uuid;
    public string $name;
    public string $sex;
    public int $age;
    public float $weight;
    public bool $neutered;
    public string $breedUuid;
    public string $petConditionUuid;

    public string $petSitterName;
    public string $petSitterEmail;

    public function __construct()
    {
      $this->setUpFaker();

      $this->petCode = $this->faker->numerify();
      $this->uuid = $this->faker->uuid();
      $this->name = $this->faker->name();
      $this->age = $this->faker->numberBetween(1, 40);
      $this->sex = $this->randomSex($this->faker->numberBetween(0, 1));
      $this->weight = $this->faker->numberBetween(1, 40);
      $this->neutered = $this->faker->boolean();
      $this->breedUuid = 'cd94c54e-91a0-421a-8f4d-c7893ccead5f';
      $this->petConditionUuid = '8e8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f';

      $this->petSitterName = $this->faker->name();
      $this->petSitterEmail = $this->faker->email();
    }

    private function randomSex(int $index)
    {
        $sexes = ['F', 'M'];

        return $sexes[$index];
    }
}