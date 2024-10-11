<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nid',
        'contact_no',
        'gender',
        'vaccine_center_id',
    ];
}
