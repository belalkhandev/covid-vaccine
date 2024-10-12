<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $appends = [
        'formatted_vaccination_date',
    ];

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

    public function getFormattedVaccinationDateAttribute()
    {
        return Carbon::parse($this->attributes['vaccination_date'])->format('d M, Y');
    }
}
