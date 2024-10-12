<?php

namespace App\Repositories\VaccineCenter\Contracts;

interface VaccineCenterRepositoryInterface
{
    public function getAll();

    public function countDailyVaccinationCapacity();
}
