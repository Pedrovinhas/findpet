<?php

namespace Tests\Services;

use App\Dtos\Pet\CreatePetDto;
use App\Repositories\Memory\BreedRepository;
use App\Repositories\Memory\PetRepository;
use App\Services\PetService;
use Tests\Fakes\Entities\CreatePet as Faker;
use Tests\TestCase;

class PetServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_should_create_animal()
    {
        $faker = new Faker();

        $service = new PetService(new PetRepository(), new BreedRepository);

        $institutionUuid = 'k3210-341-fk3-120-kf2-f3-o';

        $dto = new CreatePetDto(
            $faker->petCode,
            $faker->name,
            $faker->weight,
            $faker->age,
            $faker->neutered,
            $faker->sex,
            $faker->breedUuid,
            $faker->petConditionUuid,
            $institutionUuid
        );

        $service->create($dto);

        $animal = $service->getByPetCode($dto->petCode);

        $this->assertEquals($dto->petCode, $animal->getIdentity()->getValue());
        $this->assertEquals($dto->petConditionUuid, $animal->getPetCondition()->getUuid());
        $this->assertEquals($dto->name, $animal->getName());
        $this->assertEquals($dto->weight, $animal->getWeight());
        $this->assertEquals($dto->age, $animal->getAge());
        $this->assertEquals($dto->neutered, $animal->isNeutered());
        $this->assertEquals($dto->sex, $animal->getSex());
        $this->assertEquals($dto->breedUuid, $animal->getBreed()->getKey());
    }
}
