<?php

namespace App\Repositories\VaccineRecipient\Contracts;

interface VaccineRecipientRepositoryInterface
{
    public function store(array $data);

    public function findByNID(string $nid);
}
