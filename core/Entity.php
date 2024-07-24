<?php

namespace Core;

abstract class Entity implements Comparable
{
    private ?Identity $identity;

    protected function __construct(Identity $identity = null)
    {
        $this->setIdentity($identity);
    }

    public function getIdentity(): Identity
    {
        return $this->identity;
    }

    protected function setIdentity(?Identity $identity)
    {
        // if (!is_null($this->identity)) {
            // TODO: Lançar exceção de que não é possível alterar a identidade de uma entidade
        // }

        $this->identity = $identity;
    }

    public function equals($other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        return $this->identity->equals($other->getIdentity());
    }
}