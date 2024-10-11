<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    abstract public function model();

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model()::query();
    }
}
