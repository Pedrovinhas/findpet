<?php

namespace Tests\Services;

use App\Dtos\Pet\CreatePetDto;
use App\Exceptions\Pet\Entity\PetAlreadyExistsException;
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

    public function test_should_create_pet()
    {
        $faker = new Faker();

        $service = new PetService(new PetRepository(), new BreedRepository);

        $institutionUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

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

        $pet = $service->getByPetCode($dto->petCode);

        $this->assertEquals($dto->petCode, $pet->getIdentity()->getValue());
        $this->assertEquals($dto->petConditionUuid, $pet->getPetCondition()->getUuid());
        $this->assertEquals($dto->name, $pet->getName());
        $this->assertEquals($dto->weight, $pet->getWeight());
        $this->assertEquals($dto->age, $pet->getAge());
        $this->assertEquals($dto->neutered, $pet->isNeutered());
        $this->assertEquals($dto->sex, $pet->getSex());
        $this->assertEquals($dto->breedUuid, $pet->getBreed()->getKey());
    }

    public function test_should_not_create_pet_with_same_pet_code()
    {
      $faker = new Faker();
      $petCode = '00007';

      $service = new PetService(new PetRepository(), new BreedRepository);

      $institutionUuid = 'k3210-341-fk3-120-kf2-f3-o';

      $dto = new CreatePetDto(
          $petCode,
          $faker->name,
          $faker->weight,
          $faker->age,
          $faker->neutered,
          $faker->sex,
          $faker->breedUuid,
          $faker->petConditionUuid,
          $institutionUuid
      );
      
      $this->expectException(PetAlreadyExistsException::class);
            
      $service->create($dto);
      $service->create($dto);

    }
}
