<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailabilitySlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_availability_id',
        'start_time',
        'end_time',
        'is_booked'
    ];

    protected $casts = [
        'is_booked' => 'boolean',
    ];

    public function availability()
    {
        return $this->belongsTo(DoctorAvailability::class, 'doctor_availability_id');
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class, 'current_slot_id');
    }

    public function originalConsultation()
    {
        return $this->hasOne(Consultation::class, 'original_slot_id');
    }


}
