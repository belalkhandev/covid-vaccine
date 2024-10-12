<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    abstract public function model();

    public function query(): Builder
    {
        return $this->model()::query();
    }
}
