<?php

namespace Tests\Fakes\Entities;

use Illuminate\Foundation\Testing\WithFaker;

class CreateInstitution
{
    use WithFaker;

    public string $uuid;
    public string $street;
    public string $postalCode;
    public string $locationTypeUuid;

    public string $number;
    public string $latitude;
    public string $longitde;


    public function __construct()
    {
      $this->setUpFaker();

      $this->uuid = $this->faker->uuid();
      $this->street = $this->faker->streetName();
      $this->postalCode = $this->faker->postcode();
      $this->locationTypeUuid = $this->faker->uuid();
      
      $this->number = $this->faker->numberBetween(1, 40);
      $this->latitude = $this->faker->latitude();
      $this->longitde = $this->faker->longitude();
    }
}