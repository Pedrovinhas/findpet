<?php

namespace App\Services;

use App\Services\Contracts\PetContract as Contract; 
use App\Dtos\Pet\CreatePetDto;
use App\Dtos\Pet\FilterListPet;
use App\Dtos\Pet\PetDto;
use App\Dtos\Pet\PetSitterDto;
use App\Dtos\Pet\UpdatePetDto;
use App\Entities\Pet;
use App\Exceptions\Pet\Business\PetLostHasntPetFounderException;
use App\Exceptions\Pet\Entity\PetAlreadyExistsException;
use App\Repositories\Interfaces\BreedRepositoryInterface as BreedRepo;
use App\Repositories\Interfaces\PetRepositoryInterface as PetRepo;
use App\VOs\PetCondition;
use App\VOs\PetSitter;
use Core\Dto\DomainDto;

class PetService implements Contract
{
    public function __construct(
        private PetRepo $petRepository,
        private BreedRepo $breedRepository,
    ) {}

    public function create(CreatePetDto $dto): void
    {
        $breed = $this->breedRepository->getByUuid($dto->breedUuid);
        $petSitter = !is_null($dto->petSitter) ? PetSitter::create($dto->petSitter->name, $dto->petSitter->email)
            : null;

        $pet = Pet::create(
            $dto->petCode,
            $dto->name,
            $dto->weight,
            $dto->age,
            $dto->neutered,
            $dto->sex,
            $breed,
            $dto->institutionUuid,
            $dto->petConditionUuid,
            $petSitter,
        );
        $this->throwErrorIfHasAnimalWithCodigo($pet);

        $this->petRepository->save($pet);
    }

    public function update(string $uuid, UpdatePetDto $dto): Pet
    {
        $pet = $this->petRepository->getByUuid($uuid);
        $breed =  !is_null($dto->breedUuid) ? $this->breedRepository->getByUuid($dto->breedUuid) : $pet->getBreed();
        $petCondition = $this->handleUpdatePetCondition($pet, $dto->petConditionUuid);

        $updated = Pet::create(
            $pet->getIdentity()->getValue(),
            $dto->name ?? $pet->getName(),
            $dto->weight ?? $pet->getWeight(),
            $dto->age ?? $pet->getAge(),
            $pet->isNeutered(),
            $dto->sex ?? $pet->getSex(),
            $breed,
            $pet->getInstitutionRef(),
            $petCondition->getUuid(),
            $pet->getPetSitter(),
        );
        $this->handleUpdatePetSitter($updated, $dto->petSitter);
        $this->handleUpdateStatus($updated, $dto);

        $this->petRepository->update($updated);

        return $updated;
    }

    private function handleUpdateStatus(Pet $pet, UpdatePetDto $dto)
    {
        if (!is_null($dto->neutered) && $dto->neutered != $pet->isNeutered()) {
            $pet->castrate();
        }
    }

    private function handleUpdatePetCondition(Pet $pet, ?string $petConditionUuid = null): PetCondition
    {
        $petCondition = $pet->getPetCondition();
        if (!is_null($petConditionUuid)) {
            $petCondition = PetCondition::create($petConditionUuid);
        }

        return $petCondition;
    }

    private function handleUpdatePetSitter(Pet $pet, ?PetSitterDto $dto = null)
    {
        if ($pet->getPetCondition()->isLost()) {
            $pet->setPetSitter(null);
        } else {
            throw_if(is_null($dto), new PetLostHasntPetFounderException());

            $pet->getPetSitter()->setName($dto->name ?? $pet->getPetSitter()->getName());
            $pet->getPetSitter()->setEmail($dto->email ?? $pet->getPetSitter()->getEmail());
        }

        return $pet;
    }

    private function throwErrorIfHasAnimalWithCodigo(Pet $pet)
    {
        throw_if(
            $this->petRepository->existsPetCode($pet->getIdentity()->getValue()),
            new PetAlreadyExistsException('pet code', $pet->getIdentity()->getValue()),
        );
    }

    public function getByPetCode(string $petCode): Pet
    {
        return $this->petRepository->getByPetCode($petCode);
    }

    public function listByFilters(FilterListPet $filter): array
    {
        $pets = $this->petRepository->list($filter);

        $petDtos = array_map(function($pet) {
            $petSitterDto = null;
            if ($pet->getPetSitter()) {
                $petSitter = $pet->getPetSitter();
                $petSitterDto = new PetSitterDto($petSitter->getName(), $petSitter->getEmail());
            }

            $breed = $this->breedRepository->getByUuid($pet->getBreed()->getKey());

            return new PetDto(
                $pet->getPetCode()->getValue(),
                $pet->getName(),
                $pet->getWeight(),
                $pet->getAge(),
                $pet->isNeutered(),
                $pet->getSex(),
                new DomainDto($breed->getKey(), $breed->getName()),
                new DomainDto($pet->getPetCondition()->getUuid(), $pet->getPetCondition()->getName()),
                $petSitterDto
            );
        }, $pets);

        return $petDtos;
    }
}
