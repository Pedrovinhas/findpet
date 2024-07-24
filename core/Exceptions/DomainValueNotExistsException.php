<?php

namespace Core\Exceptions;

use Exception;

class DomainValueNotExistsException extends Exception
{
    public function __construct(
        private ?string $domain = null,
        private ?string $field = null,
        private ?string $value = null
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
