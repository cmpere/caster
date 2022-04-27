<?php

namespace LiaTec\Caster\Cast;

class AsFloor
{
    public function __invoke($value)
    {
        return floor($value);
    }
}
