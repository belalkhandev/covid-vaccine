<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_recipient_id',
        'vaccine_center_id',
        'vaccine_dosage_id',
        'vaccination_date',
    ];

    public function vaccineRecipient()
    {
        return $this->belongsTo(VaccineRecipient::class);
    }

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    public function vaccineDosage()
    {
        return $this->belongsTo(VaccineDosage::class);
    }
}
