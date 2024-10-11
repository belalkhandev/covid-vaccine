<?php

namespace App\Repositories\VaccineCenter\Eloquent;

use App\Models\VaccineCenter;
use App\Repositories\Repository;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineCenter\Contracts\VaccineRecipientRepositoryInterface;

class VaccineCenterRepository extends Repository implements VaccineCenterRepositoryInterface
{
    public function model(): string
    {
        return VaccineCenter::class;
    }

    public function getAll()
    {
        return $this->query()
            ->select('id', 'name', 'address')
            ->active()
            ->get();
    }
}
