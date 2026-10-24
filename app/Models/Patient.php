<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
