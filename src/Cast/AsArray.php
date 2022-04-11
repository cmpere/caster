<?php

namespace LiaTec\Caster\Cast;

class AsArray
{
    public function __invoke($value)
    {
        return (array) $value;
    }
}
