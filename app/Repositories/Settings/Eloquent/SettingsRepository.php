<?php

namespace App\Repositories\Settings\Eloquent;

use App\Models\Setting;
use App\Repositories\Repository;
use App\Repositories\Settings\Contracts\SettingsRepositoryInterface;

class SettingsRepository extends Repository implements SettingsRepositoryInterface
{
    public function model(): string
    {
        return Setting::class;
    }

    public function getValueByName(string $name)
    {
        return $this->query()
            ->where('name', $name)
            ->first()
            ?->value;
    }
}
