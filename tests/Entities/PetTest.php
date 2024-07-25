<?php

namespace Tests\Entities;

use Core\DomainValue;
use App\Entities\Pet;
use App\Exceptions\Pet\Business\PetRescuedHasntPetFounderException;
use App\VOs\PetSitter;
use Core\Exceptions\DomainValueNotExistsException;
use Tests\Fakes\Entities\CreatePet as Faker;
use Tests\TestCase;
use InvalidArgumentException;

class PetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_should_create_entity()
    {
        $faker = new Faker();
        $petConditionUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $institutionUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $pet = Pet::create(
            $faker->petCode,
            $faker->name,
            $faker->weight,
            $faker->age,
            $faker->neutered,
            $faker->sex,
            DomainValue::create($faker->breedUuid, $faker->breedUuid),
            $institutionUuid,
            $petConditionUuid,
            PetSitter::create(
                $faker->petSitterName,
                $faker->petSitterEmail,
            ),
        );

        $this->assertEquals($faker->petCode, $pet->getIdentity()->getValue());
        $this->assertEquals($faker->name, $pet->getName());
        $this->assertEquals($faker->weight, $pet->getWeight());
        $this->assertEquals($faker->breedUuid, $pet->getBreed()->getKey());
        $this->assertEquals($petConditionUuid, $pet->getPetCondition()->getUuid());
    }

    public function test_should_restore_entity()
    {
        $faker = new Faker();
        $petConditionUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $institutionUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $pet = Pet::restore(
            $faker->petCode,
            $faker->uuid,
            $faker->name,
            $faker->weight,
            $faker->age,
            $faker->neutered,
            DomainValue::create($faker->breedUuid, $faker->breedUuid),
            $faker->sex,
            $institutionUuid,
            $petConditionUuid,
            PetSitter::create(
              $faker->petSitterName,
              $faker->petSitterEmail,
            ),
        );

        $this->assertEquals($faker->petCode, $pet->getIdentity()->getValue());
        $this->assertEquals($faker->uuid, $pet->getUuid()); 
        $this->assertEquals($faker->name, $pet->getName());
        $this->assertEquals($faker->weight, $pet->getWeight());
        $this->assertEquals($faker->breedUuid, $pet->getBreed()->getKey());
        $this->assertEquals($petConditionUuid, $pet->getPetCondition()->getUuid());
    }

    public function test_should_not_create_entity_without_pet_founder_if_rescued()
    {
        $faker = new Faker();
        $petConditionUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $institutionUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $this->expectException(PetRescuedHasntPetFounderException::class);

        Pet::create(
          $faker->petCode,
          $faker->name,
          $faker->weight,
          $faker->age,
          $faker->neutered,
          $faker->sex,
          DomainValue::create($faker->breedUuid, $faker->breedUuid),
          $institutionUuid,
          $petConditionUuid,
        );
    }

    public function test_should_not_create_entity_if_send_a_invalid_pet_condition()
    {
      $faker = new Faker();

      $petConditionUuid = '3ef30f2d-9a85-4869-91bc-2cc2de32bdfb';
      $institutionUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

      $this->expectException(DomainValueNotExistsException::class);

      Pet::create(
        $faker->petCode,
        $faker->name,
        $faker->weight,
        $faker->age,
        $faker->neutered,
        $faker->sex,
        DomainValue::create($faker->breedUuid, $faker->breedUuid),
        $institutionUuid,
        $petConditionUuid,
      );
    }
}
