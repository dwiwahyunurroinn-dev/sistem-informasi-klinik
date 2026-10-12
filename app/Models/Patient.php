<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'medical_record_number',
        'name',
        'gender',
        'birth_date',
        'address',
        'phone',
    ];
}