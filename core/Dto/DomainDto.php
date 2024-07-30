<?php

namespace Core\Dto;

class DomainDto
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $description
    ) {
    }
}