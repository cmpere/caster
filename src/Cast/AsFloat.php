<?php

namespace LiaTec\Caster\Cast;

class AsFloat
{
    public function __invoke($value)
    {
        return (float) $value;
    }
}
