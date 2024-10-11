<?php

namespace App\Repositories\VaccineRecipient\Eloquent;

use App\Models\VaccineRecipient;
use App\Repositories\Repository;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;

class VaccineRecipientRepository extends Repository implements VaccineRecipientRepositoryInterface
{
    public function model(): string
    {
        return VaccineRecipient::class;
    }

    public function store(array $data)
    {
        return $this->query()->create([
            'name' => $data['name'],
            'nid' => $data['nid'],
            'contact_no' => $data['contact_no'],
            'gender' => $data['gender'],
            'vaccine_center_id' => $data['vaccine_center_id'],
        ]);
    }

    public function findByNID(string $nid)
    {
        return $this->query()
            ->with([
                'vaccineCenter',
                'vaccine',
                'vaccine.vaccineCenter',
                'vaccine.vaccineDosage',
            ])
            ->where('nid', $nid)
            ->first();
    }
}
