<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'daily_vaccination_capacity',
    ];

    public function vaccineDosages()
    {
        return $this->belongsToMany(VaccineDosage::class, 'vaccine_center_dosages', 'vaccine_center_id', 'vaccine_dosage_id');
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', 1);
    }
}
