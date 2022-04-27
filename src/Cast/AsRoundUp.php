<?php

namespace LiaTec\Caster\Cast;

class AsRoundUp
{
    protected $decimals;

    public function __construct($decimals)
    {
        $this->decimals = $decimals;
    }

    public function __invoke($value)
    {
        return round($value, $this->decimals, PHP_ROUND_HALF_UP);
    }
}
