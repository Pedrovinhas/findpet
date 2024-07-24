<?php

namespace Core\Exceptions;

use Exception;

abstract class BusinessException extends Exception
{
    protected function __construct(
        protected string $businessMessage
    ) {
        $this->businessMessage = $businessMessage;
    }

    public function message()
    {
        return $this->businessMessage;
    }
}
