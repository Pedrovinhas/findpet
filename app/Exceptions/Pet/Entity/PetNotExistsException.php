<?php

namespace App\Exceptions\Pet\Entity;

class PetNotExistsException extends PetException
{
  public function __construct(
    private ?string $field = null, 
    private ?string $value = null
  )
  {
      parent::__construct();

      $this->field = $field;
      $this->value = $value;
  }

    public function getField()
    {
        return $this->field;
    }

    public function getValue()
    {
        return $this->value;
    }
}
