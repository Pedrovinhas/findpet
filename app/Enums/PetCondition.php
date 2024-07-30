<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum PetCondition: string
{
  case HEALTHY = '3d7e5c3b-8f74-4a6b-bbce-53a4b8a6a1df';
  case SICK = '5c8f2e1a-0c34-4e58-a1ef-5a8a9e8a2ef1';
  case RESCUED = '8e8a4f5b-7c3e-4f7b-b5a9-8f7e9d2b3e4f';
  case LOST = '5551108a-dd5a-434f-9d2c-bbde4533396b';

  public static function values(): array
  {
      return [
          self::HEALTHY->value => 'Healthy',
          self::SICK->value => 'Sick',
          self::RESCUED->value => 'Rescued',
          self::LOST->value => 'Lost'
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

    public function name(): string
    {
        return Arr::get(static::values(), $this->value);
    }
}