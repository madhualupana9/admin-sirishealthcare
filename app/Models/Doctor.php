<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'education',
        'specialty_id',
        'hospital_id',
        'experience',
        'languages',
        'country',
        'about_expert',
        'education_training',
        'professional_work',
        'photo',
        'consultation_fee',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::created(function ($doctor) {
            if ($doctor->is_active) {
                Log::info("Auto-generating slots for newly created doctor {$doctor->id}");
                $doctor->generateAvailabilitySlots();
            }
        });

        static::updated(function ($doctor) {
            if ($doctor->is_active && $doctor->wasChanged('is_active')) {
                Log::info("Auto-generating slots for activated doctor {$doctor->id}");
                $doctor->generateAvailabilitySlots();
            }
        });
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hostel::class, 'hospital_id');
    }

    public function availabilities()
    {
        return $this->hasMany(DoctorAvailability::class);
    }

    public function upcomingAvailabilities()
    {
        return $this->availabilities()
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time');
    }

    public function availabilitySlots()
    {
        return $this->hasMany(DoctorAvailabilitySlot::class);
    }

    public function generateAvailabilitySlots()
    {
        if (!$this->is_active) {
            Log::info("Doctor {$this->id} is not active - skipping slot generation");
            return;
        }

        $startTime = '16:00:00'; // 4:00 PM
        $endTime = '18:00:00';   // 6:00 PM
        $slotDuration = 15; // minutes

        Log::info("Generating slots for doctor {$this->id} from {$startTime} to {$endTime}");

        for ($i = 1; $i <= 2; $i++) {
            $date = now()->addDays($i)->format('Y-m-d');
            Log::info("Processing date: {$date}");

            $availability = $this->availabilities()->firstOrCreate([
                'date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);

            if ($availability->slots()->count() === 0) {
                Log::info("Generating slots for availability {$availability->id}");
                $this->generateSlotsForAvailability($availability, $startTime, $endTime, $slotDuration);
            } else {
                Log::info("Slots already exist for availability {$availability->id}");
            }
        }
    }

    protected function generateSlotsForAvailability($availability, $startTime, $endTime, $duration)
    {
        $start = \Carbon\Carbon::parse($startTime);
        $end = \Carbon\Carbon::parse($endTime);

        Log::info("Creating slots between {$start->format('H:i:s')} and {$end->format('H:i:s')}");

        while ($start->addMinutes($duration)->lte($end)) {
            $slotStart = $start->copy()->subMinutes($duration);
            $slotEnd = $start->copy();

            $slot = $availability->slots()->create([
                'start_time' => $slotStart->format('H:i:s'),
                'end_time' => $slotEnd->format('H:i:s'),
                'is_booked' => false
            ]);

            Log::info("Created slot ID {$slot->id}: {$slotStart->format('H:i:s')} to {$slotEnd->format('H:i:s')}");
        }
    }

    public function getUpcomingAvailability()
    {
        return $this->availabilities()
            ->with('slots')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->get();
    }

    public static function generateSlotsForAllActiveDoctors()
    {
        $activeDoctors = self::where('is_active', true)->get();

        Log::info("Generating slots for all active doctors (count: {$activeDoctors->count()})");

        foreach ($activeDoctors as $doctor) {
            $doctor->generateAvailabilitySlots();
        }
    }


    public function getAvailabilityForDates(array $dates)
    {
        return DoctorAvailability::with(['slots' => function($query) {
            $query->orderBy('start_time');
        }])
        ->where('doctor_id', $this->id)
        ->whereIn('date', $dates)
        ->orderBy('date')
        ->get()
        ->map(function($availability) {
            return (object)[
                'date' => $availability->date,
                'slots' => $availability->slots->map(function($slot) use ($availability) {
                    $slot->availability = $availability;
                    return $slot;
                })
            ];
        });
    }
}
