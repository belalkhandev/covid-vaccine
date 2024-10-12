<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineRecipient extends Model
{
    use HasFactory;

    protected $appends = [
        'formatted_created_at',
    ];

    protected $fillable = [
        'name',
        'nid',
        'email',
        'contact_no',
        'gender',
        'vaccine_center_id',
        'status',
    ];

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    public function vaccine()
    {
        return $this->hasOne(Vaccine::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M, Y');
    }
}
