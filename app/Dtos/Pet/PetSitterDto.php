<?php

namespace App\Dtos\Pet;

class PetSitterDto
{
    public function __construct(
      public readonly string $name, 
      public readonly string $email
      )
    {}
}
