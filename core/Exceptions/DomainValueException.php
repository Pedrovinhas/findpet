<?php

namespace Core\Exceptions;

use Exception;

abstract class DomainValueException extends Exception
{
    protected function __construct(
        private ?string $domain,
        private ?string $field = null,
        private ?string $value = null,
    ) {
        $this->domain = $domain;
        $this->field = $field;
        $this->value = $value;
    }

    public function getDomain()
    {
        return $this->domain;
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
