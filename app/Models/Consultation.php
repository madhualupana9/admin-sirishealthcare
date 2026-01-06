<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;


class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'age',
        'contact_info',
        'problem_description',
        'specialty',
        'appointment_time',
        'payment_method',
        'payu_payment_id',
        'payu_order_id',
        'payu_signature',
        'bank_reference',
        'payment_mode',
        'amount',
        'currency',
        'payment_status',
        'invoice_id',
        'refund_status',
        'consultation_status',
        'notes',
        'status',
        'original_slot_id',
        'current_slot_id',
        'cancellation_reason_id',
        'cancellation_notes',
        'payment_reference',
        'payment_error',
        'doctor_id'
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
        'amount' => 'decimal:2',
    ];

     public function slot(): BelongsTo
    {
        return $this->belongsTo(DoctorAvailabilitySlot::class, 'current_slot_id');
    }

    public function originalSlot(): BelongsTo
    {
        return $this->belongsTo(DoctorAvailabilitySlot::class, 'original_slot_id');
    }

    public function cancellationReason(): BelongsTo
    {
        return $this->belongsTo(CancellationReason::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function specialtyModel(): BelongsTo
    {
        return $this->belongsTo(Specialty::class, 'specialty', 'name');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }

}
