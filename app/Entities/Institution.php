<?php

namespace App\Entities;

use Core\DomainValue;
use Core\Entity;
use Core\UuidIdentity;
use Ramsey\Uuid\Rfc4122\UuidV4 as Uuid;

class Institution extends Entity
{
    private function __construct(
        private UuidIdentity $uuid,
        private string $street,
        private string $postalCode,
        private DomainValue $locationType,
        private string $cityUuid,
        private string $ambassadorUuid,
        private ?string $number = null,
        private ?float $latitude = null,
        private ?float $longitude = null
    ) {
        parent::__construct($uuid);

        $this->setCoordinates($latitude, $longitude);
        $this->setNumber($number);
        $this->setStreet($street);
    }

    public static function create(
        string $street,
        string $postalCode,
        DomainValue $locationType,
        string $cityUuid,
        string $ambassadorUuid,
        ?string $number = null,
        ?float $latitude = null,
        ?float $longitude = null
    ) {
        $uuid = Uuid::uuid4();
        return new static(new UuidIdentity($uuid), $street, $postalCode, $locationType, $cityUuid, $ambassadorUuid, $number, $latitude, $longitude);
    }

    public static function restore(
        string $uuid,
        string $street,
        string $postalCode,
        DomainValue $locationType,
        string $cityUuid,
        string $ambassadorUuid,
        ?string $number = null,
        ?float $latitude = null,
        ?float $longitude = null
    ) {
        return new static(new UuidIdentity($uuid), $street, $postalCode, $locationType, $cityUuid, $ambassadorUuid, $number, $latitude, $longitude);
    }

    public function setCoordinates(?float $latitude, ?float $longitude)
    {
        if ((is_null($latitude) && !is_null($longitude)) || (!is_null($latitude) && is_null($longitude))) {
            throw new \InvalidArgumentException('Cannot have coordinates without latitude or longitude.');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    private function throwErrorIfLengthExceeded(string $value, string $message)
    {
        if (strlen($value) > 45) {
            throw new \InvalidArgumentException($message);
        }
    }

    public function setNumber(?string $value = null)
    {
        if (!is_null($value)) {
            $this->throwErrorIfLengthExceeded($value, 'Number exceeds character limit.');
        }
        $this->number = $value;
    }

    public function setStreet(string $value)
    {
        $this->throwErrorIfLengthExceeded($value, 'Street exceeds character limit.');
        $this->street = $value;
    }

    public function getAmbassadorRef()
    {
        return $this->ambassadorUuid;
    }

    public function getCityRef()
    {
        return $this->cityUuid;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function hasCoordinates()
    {
        return (!is_null($this->latitude) && !is_null($this->longitude));
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getLocationType()
    {
        return $this->locationType;
    }
  }