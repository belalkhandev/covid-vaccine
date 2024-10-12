<?php

namespace App\Repositories\VaccineCenter\Eloquent;

use App\Models\VaccineCenter;
use App\Repositories\Repository;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;

class VaccineCenterRepository extends Repository implements VaccineCenterRepositoryInterface
{
    public function model(): string
    {
        return VaccineCenter::class;
    }

    public function getAll()
    {
        return $this->query()
            ->select('id', 'name', 'address', 'daily_vaccination_capacity')
            ->with('vaccineDosages')
            ->active()
            ->get();
    }

    public function countDailyVaccinationCapacity()
    {
        return $this->query()
            ->active()
            ->sum('daily_vaccination_capacity');
    }
}
