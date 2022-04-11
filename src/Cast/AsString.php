<?php

namespace LiaTec\Caster\Cast;

class AsString
{
    public function __invoke($data)
    {
        return (string) $data;
    }
}
