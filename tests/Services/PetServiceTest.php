<?php

namespace Tests\Services;

use App\Dtos\Pet\CreatePetDto;
use App\Dtos\Pet\FilterListPet;
use App\Dtos\Pet\PetSitterDto;
use App\Dtos\Pet\UpdatePetDto;
use App\Exceptions\Pet\Entity\PetAlreadyExistsException;
use App\Exceptions\Pet\Entity\PetNotExistsException;
use App\Repositories\Memory\BreedRepository;
use App\Repositories\Memory\PetRepository;
use App\Services\PetService;
use Tests\Factories\PetFactory;
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

    public function test_should_update_pet()
    {
      $petRepo = new PetRepository();
      $petFactory = new PetFactory($petRepo);
      $service = new PetService($petRepo, new BreedRepository());

      $pet = $petFactory->createPet();
      $faker = new Faker();

        $breedUuid = '45678c90-2345-6789-0123-22324c256789';
        $petConditionUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';

        $updateDto = new UpdatePetDto(
          $pet->getPetCode()->getValue(),
          'Bilu',
          15,
          7,
          $faker->neutered,
          'F',
          $breedUuid,
          $petConditionUuid
        );
        $petSitterDto = new PetSitterDto(
          $faker->petSitterName,
          $faker->petSitterEmail
        );
        $updateDto->setPetSitter($petSitterDto);

        $service->update($pet->getUuid(), $updateDto);

        // The problem was solved by changing create a pet new instance, to use restore method passing the uuid to it. 
        $pet = $service->getByPetCode($pet->getPetCode()->getValue());

        $this->assertEquals('Bilu', $pet->getName());
        $this->assertEquals(15.0, $pet->getWeight());
        $this->assertEquals(7, $pet->getAge());
        $this->assertEquals('F', $pet->getSex());
        $this->assertEquals($breedUuid, $pet->getBreed()->getKey());
        $this->assertEquals($petConditionUuid, $pet->getPetCondition()->getUuid());
    }

    public function test_should_not_update_nonexistent_pet()
    {
        $service = new PetService(new PetRepository(), new BreedRepository());

        $nonExistentPetCode = '99999';
        $updateDto = new UpdatePetDto(name: 'Updated Name');

        $this->expectException(PetNotExistsException::class);

        $service->update($nonExistentPetCode, $updateDto);
    }

    public function test_should_delete_pet()
    {
      $filter = new FilterListPet();
      $petRepo = new PetRepository();
      $petFactory = new PetFactory($petRepo);
      $service = new PetService($petRepo, new BreedRepository());

      $pet = $petFactory->createPet();

      $service->delete($pet->getPetCode()->getValue());

      $pets = $service->listByFilters($filter);

      $this->assertCount(1, $pets);
    }
}
