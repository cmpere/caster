<?php

namespace LiaTec\Caster\Cast;

class AsTrim
{
    public function __invoke($value)
    {
        return trim($value);
    }
}
