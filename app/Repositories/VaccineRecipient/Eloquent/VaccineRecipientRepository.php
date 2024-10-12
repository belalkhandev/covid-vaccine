<?php

namespace App\Repositories\VaccineRecipient\Eloquent;

use App\Enums\VaccineStatus;
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

    public function getByIds(array $ids)
    {
        return $this->query()
            ->with([
                'vaccineCenter',
                'vaccine',
                'vaccine.vaccineCenter',
                'vaccine.vaccineDosage',
            ])
            ->whereIn('id', $ids)
            ->get();
    }

    public function findById(string $id)
    {
        return $this->query()
            ->with([
                'vaccineCenter',
                'vaccine',
                'vaccine.vaccineCenter',
                'vaccine.vaccineDosage',
            ])
            ->find($id);
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

    public function getByPaginate(array $filterOptions, ?int $perPage = 15)
    {
        return $this->query()
            ->select('vaccine_recipients.*')
            ->with([
                'vaccineCenter',
                'vaccine',
                'vaccine.vaccineCenter',
                'vaccine.vaccineDosage',
            ])
            ->leftJoin('vaccines', 'vaccine_recipients.id', '=', 'vaccines.vaccine_recipient_id')
            ->when($filterOptions['nid'], function ($query) use ($filterOptions) {
                return $query->where('vaccine_recipients.nid', $filterOptions['nid']);
            })
            ->when($filterOptions['vaccine_center'], function ($query) use ($filterOptions) {
                return $query->where(function ($query) use ($filterOptions) {
                    $query->where('vaccines.vaccine_center_id', $filterOptions['vaccine_center'])
                        ->orWhere('vaccine_recipients.vaccine_center_id', $filterOptions['vaccine_center']);
                });
            })
            ->when($filterOptions['vaccine_date'], function ($query) use ($filterOptions) {
                return $query->whereDate('vaccines.vaccination_date', $filterOptions['vaccine_date']);
            })
            ->when($filterOptions['status'], function ($query) use ($filterOptions) {
                return $query->where('vaccine_recipients.status', $filterOptions['status']);
            })
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getUnassignedRecipients()
    {
        return $this->query()
            ->select('id')
            ->where('status', VaccineStatus::REGISTERED->value);
    }

    public function getScheduledVaccineRecipientsForUpdateStatus(array $with = [])
    {
        return $this->query()
            ->select('vaccine_recipients.*')
            ->when(! empty($with), function ($query) use ($with) {
                $query->with($with);
            })
            ->leftJoin('vaccines', 'vaccines.vaccine_recipient_id', 'vaccine_recipients.id')
            ->whereDate('vaccination_date', '<', now()->format('Y-m-d'))
            ->where('status', VaccineStatus::SCHEDULED->value)
            ->get();
    }

    public function getScheduledVaccineRecipients(array $with = [])
    {
        return $this->query()
            ->select('vaccine_recipients.*')
            ->when(! empty($with), function ($query) use ($with) {
                $query->with($with);
            })
            ->leftJoin('vaccines', 'vaccines.vaccine_recipient_id', 'vaccine_recipients.id')
            ->where('status', VaccineStatus::SCHEDULED->value)
            ->get();
    }
}
