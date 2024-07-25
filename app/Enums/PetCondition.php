<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum PetCondition: string
{
  case HEALTHY = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
  case SICK = '5c8f2e1a-0c34-4e58-a1ef-5a8a9e8a2ef1';
  case RESCUED = '8e8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f';

  public static function values(): array
  {
      return [
          self::HEALTHY->value => 'Healthy',
          self::SICK->value => 'Sick',
          self::RESCUED->value => 'Rescued',
      ];
  }

  public static function isValidValue(string $value): bool
  {
      return in_array($value, array_keys(self::values()), true);
  }

    public function key(): string
    {
        return $this->value;
    }

    public function description(): string
    {
        return Arr::get(static::values(), $this);
    }
}