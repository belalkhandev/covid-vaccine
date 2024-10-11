<?php

namespace App\Providers;

use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineCenter\Eloquent\VaccineCenterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VaccineCenterRepositoryInterface::class, VaccineCenterRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
