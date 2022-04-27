<?php

namespace LiaTec\Caster\Cast;

class AsTruncate
{
    protected $len;

    public function __construct($len)
    {
        $this->len = $len;
    }

    public function __invoke($value)
    {
        return substr((string) $value, 0, $this->len);
    }
}
