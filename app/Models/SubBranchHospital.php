<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBranchHospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'name',
        'image',
        'city',
        'state',
        'address',
        'description',
        'contact_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hostel::class, 'hospital_id');
    }
}
