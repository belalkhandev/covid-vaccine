<?php

namespace App\Repositories\Vaccine\Eloquent;

use App\Models\Vaccine;
use App\Repositories\Repository;
use App\Repositories\Vaccine\Contracts\VaccineRepositoryInterface;

class VaccineRepository extends Repository implements VaccineRepositoryInterface
{
    public function model(): string
    {
        return Vaccine::class;
    }

    public function store(array $data)
    {
        return $this->query()
            ->create([
                'vaccine_recipient_id' => $data['vaccine_recipient_id'],
                'vaccine_center_id' => $data['vaccine_center_id'],
                'vaccine_dosage_id' => $data['vaccine_dosage_id'],
                'vaccination_date' => $data['vaccination_date'],
            ]);
    }
}
