<?php

namespace Tests\Entities;

use App\Entities\Institution;
use Core\DomainValue;
use Core\Exceptions\DomainValueNotExistsException;
use Tests\Fakes\Entities\CreateInstitution as Faker;
use InvalidArgumentException;
use Tests\TestCase;

class InstitutionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_should_create_entity()
    {
        $faker = new Faker();
        $cityUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $ambassadorUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $institution = Institution::create(
            $faker->street,
            $faker->postalCode,
            DomainValue::create($faker->locationTypeUuid, $faker->locationTypeUuid),
            $cityUuid,
            $ambassadorUuid,
            $faker->number,
            $faker->latitude,
            $faker->longitde
        );

        $this->assertNotEmpty($institution->getIdentity()->getValue());
        $this->assertEquals($faker->street, $institution->getStreet());
        $this->assertEquals($faker->postalCode, $institution->getPostalCode());
        $this->assertEquals($faker->locationTypeUuid, $institution->getLocationType()->getKey());
        $this->assertEquals($ambassadorUuid, $institution->getAmbassadorRef());
    }

    public function test_should_restore_entity()
    {
        $faker = new Faker();
        $cityUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $ambassadorUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $institution = Institution::restore(
          $faker->uuid,
          $faker->street,
          $faker->postalCode,
          DomainValue::create($faker->locationTypeUuid, $faker->locationTypeUuid),
          $cityUuid,
          $ambassadorUuid,
          $faker->number,
          $faker->latitude,
          $faker->longitde
        );

        $this->assertNotEmpty($institution->getIdentity()->getValue());
        $this->assertEquals($faker->street, $institution->getStreet());
        $this->assertEquals($faker->postalCode, $institution->getPostalCode());
        $this->assertEquals($faker->locationTypeUuid, $institution->getLocationType()->getKey());
        $this->assertEquals($ambassadorUuid, $institution->getAmbassadorRef());
    }

    public function test_should_not_create_entity_if_exceed_characters_limits()
    {
        $faker = new Faker();
        $cityUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $ambassadorUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $number = str_repeat('a', 46);

        $this->expectException(InvalidArgumentException::class);

        Institution::restore(
          $faker->uuid,
          $faker->street,
          $faker->postalCode,
          DomainValue::create($faker->locationTypeUuid, $faker->locationTypeUuid),
          $cityUuid,
          $ambassadorUuid,
          $number,
          $faker->latitude,
          $faker->longitde
        );
    }

    public function test_should_not_create_entity_if_only_longitde_or_latitude_informed()
    {
        $faker = new Faker();
        $cityUuid = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
        $ambassadorUuid = 'e486c3e9-7a97-49b3-a2ca-d8e5718f1f8e';

        $number = str_repeat('a', 46);

        $this->expectException(InvalidArgumentException::class);

        Institution::restore(
          $faker->uuid,
          $faker->street,
          $faker->postalCode,
          DomainValue::create($faker->locationTypeUuid, $faker->locationTypeUuid),
          $cityUuid,
          $ambassadorUuid,
          $number,
          $faker->latitude,
        );
    }
}
