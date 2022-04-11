<?php

namespace LiaTec\Caster\Cast;

class AsInteger
{
    public function __invoke($value)
    {
        return (int) $value;
    }
}
