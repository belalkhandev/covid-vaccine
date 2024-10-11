<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
