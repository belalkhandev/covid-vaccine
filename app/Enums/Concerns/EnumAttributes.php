<?php

namespace App\Enums\Concerns;

trait EnumAttributes
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
