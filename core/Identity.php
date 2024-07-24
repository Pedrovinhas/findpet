<?php

namespace Core;

interface Identity extends Comparable
{
    static function generate(): self;

    function getValue();
}
