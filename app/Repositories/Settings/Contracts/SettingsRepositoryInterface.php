<?php

namespace App\Repositories\Settings\Contracts;

interface SettingsRepositoryInterface
{
    public function getValueByName(string $name);
}
