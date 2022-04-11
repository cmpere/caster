<?php

namespace LiaTec\Caster\Cast;

class AsCurrency
{
    public function __invoke($value)
    {
        return round($value, 2);
    }
}
