<?php

namespace App\Repositories\VaccineRecipient\Contracts;

interface VaccineRecipientRepositoryInterface
{
    public function store(array $data);

    public function getByIds(array $ids);

    public function findById(string $id);

    public function findByNID(string $nid);

    public function getByPaginate(array $filterOptions, ?int $perPage);

    public function getUnassignedRecipients();

    public function getScheduledVaccineRecipientsForUpdateStatus(array $with = []);

    public function getScheduledVaccineRecipients(array $with = []);
}
