<?php

namespace App\Entities;

use App\Exceptions\Pet\Business\PetRescuedHasntPetFounderException;
use Core\DomainValue;
use Core\Entity;
use App\VOs\PetCode;
use App\VOs\PetCondition;
use App\VOs\PetSitter;
use Ramsey\Uuid\Rfc4122\UuidV4 as Uuid;

final class Pet extends Entity
{
    private function __construct(
        private PetCode $petCode,
        private string $uuid,
        private string $name,
        private float $weight,
        private int $age,
        private bool $neutered,
        private string $sex,
        private DomainValue $breed,
        private string $institutionUuid,
        private PetCondition $petCondition,
        private ?PetSitter $petSitter = null
    ) {
        parent::__construct($petCode);

        $this->uuid = $uuid;
        $this->name = $name;
        $this->setWeight($weight);
        $this->setAge($age);
        $this->neutered = $neutered;
        $this->breed = $breed;
        $this->sex = $sex;
        $this->institutionUuid = $institutionUuid;
        $this->petCondition = $petCondition;
        $this->petSitter = $petSitter;
    }

    public static function create(
        string $petCode,
        string $name,
        float $weight,
        int $age,
        bool $neutered,
        string $sex,
        DomainValue $breed,
        string $institutionUuid,
        string $petConditionUuid,
        ?PetSitter $petSitter = null
    ) {
      $petCondition = PetCondition::create($petConditionUuid);

      if (is_null($petSitter)) {
        throw_unless($petCondition->isRescued(), new PetRescuedHasntPetFounderException());
    }

        return new static(
            PetCode::restore($petCode),
            Uuid::uuid4(),
            $name,
            $weight,
            $age,
            $neutered,
            $sex,
            $breed,
            $institutionUuid,
            PetCondition::create($petConditionUuid),
            $petSitter
        );
    }

    public static function restore(
        string $petCode,
        string $uuid,
        string $name,
        float $weight,
        int $age,
        bool $neutered,
        DomainValue $breed, 
        string $sex,
        string $institutionUuid,
        string $petConditionUuid,
        PetSitter $petSitter = null
    ) {
        return new static(
            PetCode::restore($petCode),
            $uuid,
            $name,
            $weight,
            $age,
            $neutered,
            $sex,  
            $breed,
            $institutionUuid,
            PetCondition::create($petConditionUuid),
            $petSitter
        );
    }

    public function setWeight(float $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('Weight cannot be equal or less than zero.');
        }

        $this->weight = $value;
    }

    public function setAge(int $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('Age cannot be less than zero.');
        }

        $this->age = $value;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function getPetSitter()
    {
        return $this->petSitter;
    }

    public function getInstitutionRef()
    {
        return $this->institutionUuid;
    }

    public function getPetCondition()
    {
        return $this->petCondition;
    }

    public function isNeutered()
    {
        return $this->neutered;
    }

    public function setPetSitter(?PetSitter $petSitter)
    {
        $this->petSitter = $petSitter;
    }
}