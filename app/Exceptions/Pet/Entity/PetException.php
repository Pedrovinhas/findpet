<?php

namespace App\Exceptions\Pet\Entity;

use Exception;

abstract class PetException extends Exception
{
    protected string $entity;

    protected function __construct()
    {
        $this->entity = 'animal';
    }

    public function getEntity()
    {
        return $this->entity;
    }
}