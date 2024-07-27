<?php

namespace App\Exceptions\Pet\Business;

use Core\Exceptions\BusinessException;

final class PetLostHasntPetFounderException extends BusinessException
{
    public function __construct()
    {
      parent::__construct('For found pets, it is necessary to provide the information of the person who found them.');
    }
}