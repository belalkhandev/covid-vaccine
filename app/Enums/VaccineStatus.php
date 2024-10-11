<?php

namespace App\Enums;

use App\Enums\Concerns\EnumAttributes;

enum VaccineStatus: string
{
    use EnumAttributes;

    case NOT_REGISTERED = 'not_registered';

    case NOT_SCHEDULED = 'not_scheduled';

    case SCHEDULED = 'scheduled';

    case VACCINATED = 'vaccinated';

    public function label(): string
    {
        return match ($this) {
            self::NOT_SCHEDULED => 'Not scheduled',
            self::SCHEDULED => 'Scheduled',
            self::VACCINATED => 'Vaccinated',
            default => 'Not registered',
        };
    }
}
