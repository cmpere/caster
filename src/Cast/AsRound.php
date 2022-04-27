<?php

namespace LiaTec\Caster\Cast;

class AsRound
{
    protected $decimals;

    public function __construct($decimals)
    {
        $this->decimals = $decimals;
    }

    public function __invoke($value)
    {
        return round($value, $this->decimals);
    }
}
