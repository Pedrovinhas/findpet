<?php

namespace Tests\Factories;

use App\Entities\Pet;
use Core\DomainValue;
use App\Repositories\Memory\BreedRepository;
use App\Repositories\Memory\PetRepository;
use App\VOs\PetSitter;
use Tests\Fakes\Entities\CreatePet as Faker;
use Illuminate\Foundation\Testing\WithFaker;

class PetFactory
{
    use WithFaker;

    public function __construct(
      private readonly PetRepository $petRepo)
    {
        $this->setUpFaker();
    }

    public function createPet()
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
    
     $this->petRepo->save($pet);

      return $pet;
    }
}