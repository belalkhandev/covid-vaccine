<?php

namespace App\Providers;

use App\Repositories\Settings\Contracts\SettingsRepositoryInterface;
use App\Repositories\Settings\Eloquent\SettingsRepository;
use App\Repositories\Vaccine\Contracts\VaccineRepositoryInterface;
use App\Repositories\Vaccine\Eloquent\VaccineRepository;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineCenter\Eloquent\VaccineCenterRepository;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use App\Repositories\VaccineRecipient\Eloquent\VaccineRecipientRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VaccineCenterRepositoryInterface::class, VaccineCenterRepository::class);
        $this->app->bind(VaccineRecipientRepositoryInterface::class, VaccineRecipientRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(VaccineRepositoryInterface::class, VaccineRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
