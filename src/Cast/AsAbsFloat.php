<?php

namespace LiaTec\Caster\Cast;

class AsAbsFloat
{
    public function __invoke($value)
    {
        return abs((float) $value);
    }
}
