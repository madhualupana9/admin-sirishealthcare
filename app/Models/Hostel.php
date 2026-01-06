<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_name',
        'image',
        'city',
        'state',
        'description',
        'contact_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
}