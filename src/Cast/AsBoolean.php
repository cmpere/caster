<?php

namespace LiaTec\Caster\Cast;

class AsBoolean
{
    public function __invoke($data)
    {
        if (is_string($data) && 0 == strlen(trim($data))) {
            return false;
        }

        if (is_string($data) && 0 == strcmp(trim($data), 'true')) {
            return true;
        }

        if (is_string($data) && 0 == strcmp(trim($data), 'false')) {
            return false;
        }

        if (is_numeric($data) && 0 == $data) {
            return false;
        }

        if (is_numeric($data) && 1 <= $data) {
            return true;
        }

        if (is_array($data)) {
            return count($data) > 0;
        }

        return (bool) $data;
    }
}
