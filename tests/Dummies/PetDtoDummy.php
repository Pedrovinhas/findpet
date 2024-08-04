<?php

namespace Tests\Dummies;

use App\Dtos\Pet\CreatePetDto;
use Illuminate\Foundation\Testing\WithFaker;

class PetDtoDummy extends CreatePetDto
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();

        parent::__construct(
            $this->faker->numerify(),
            $this->faker->name(),
            $this->faker->numberBetween(1, 40),
            $this->faker->numberBetween(1, 40),
            $this->faker->boolean(),
            $this->randomSex($this->faker->numberBetween(0, 1)),
            'cd94c54e-91a0-421a-8f4d-c7893ccead5f',
            '8e8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f',
            'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e',
        );
    }

    private function randomSex(int $index)
    {
        $sexs = ['F', 'M'];

        return $sexs[$index];
    }

    public function __clone()
    {
        $this->petCode = $this->faker->numerify();
    }

    public function setCode(string $code): void
    {
        $this->petCode = $code;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setBreed(string $breedUuid): void
    {
        $this->breedUuid = $breedUuid;
    }

    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }
}