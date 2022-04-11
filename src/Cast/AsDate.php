<?php

namespace LiaTec\Caster\Cast;

use Carbon\Carbon;

class AsDate
{
    public function __invoke($value)
    {
        $date      = strtolower($value);
        $sanitized = str_replace(
            [
                '/', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic',
            ],
            [
                '-', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec',
            ],
            $date
        );

        return Carbon::parse($sanitized);
    }
}
