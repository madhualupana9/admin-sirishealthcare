<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'doctor_name',
        'doctor_specialty',
        'first_name',
        'last_name',
        'country_code',
        'phone',
        'email',
        'city',
        'country',
        'convenient_time',
        'doctor_enquiry_status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
