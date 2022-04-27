<?php

namespace LiaTec\Caster\Cast;

class AsCeil
{
    public function __invoke($value)
    {
        return ceil($value);
    }
}
