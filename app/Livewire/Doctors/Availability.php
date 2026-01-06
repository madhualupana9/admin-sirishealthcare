<?php

namespace App\Livewire\Doctors;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\DoctorAvailabilitySlot;
use App\Models\Consultation;
use App\Models\CancellationReason;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Availability extends Component
{
    public $doctor;
    public $availabilitySlots = [];
    public $selectedDate;
    public $showDatePicker = false;

    // For appointment management
    public $selectedSlot = null;
    public $showAppointmentModal = false;
    public $showCancelModal = false;
    public $showRescheduleModal = false;
    public $cancellationReasons = [];
    public $selectedCancellationReason = null;
    public $newSlotId = null;
    public $availableRescheduleSlots = [];

    // For success message
    public $showSuccessModal = false;
    public $successMessage = '';

    // For booking form
    public $showBookingForm = false;
    public $full_name;
    public $contact_info;
    public $email;
    public $age;
    public $specialty;
    public $problem_description;
    public $payment_method = 'cash';
    public $amount;
    public $consultation_status = 'pending';
    public $payment_status = 'pending';
    public $specialties = [];

    // Loading states
    public $isRescheduling = false;
    public $isCancelling = false;

    public $showBookingDetails = false;

    public function mount(Doctor $doctor)
    {
        $this->doctor = $doctor;
        $this->selectedDate = now()->format('Y-m-d');
        $this->loadDefaultSlots();
        $this->cancellationReasons = CancellationReason::getActiveReasons();
        $this->specialties = Specialty::all();
        $this->amount = $this->doctor->consultation_fee;
        $this->specialty = $this->doctor->specialty_id;
    }

    public function updatedSelectedDate($value)
    {
        if ($this->showDatePicker && $value) {
            $this->loadSlotsForSelectedDate();
        }
    }

    public function loadDefaultSlots()
    {
        // Show tomorrow and day after tomorrow by default
        $tomorrow = Carbon::tomorrow();
        $dayAfterTomorrow = Carbon::tomorrow()->addDay();

        $this->availabilitySlots = $this->doctor->getAvailabilityForDates([
            $tomorrow->format('Y-m-d'),
            $dayAfterTomorrow->format('Y-m-d')
        ]);
    }

    public function refreshSlots()
    {
        $this->doctor->generateAvailabilitySlots();
        if ($this->showDatePicker) {
            $this->loadSlotsForSelectedDate();
        } else {
            $this->loadDefaultSlots();
        }
    }


    public function toggleSlot($date, $slotId)
    {
        // First check if the date is in the past
        if (Carbon::parse($date)->isPast()) {
            session()->flash('error', 'Cannot modify slots for past dates');
            return;
        }

        $slot = DoctorAvailabilitySlot::find($slotId);

        if ($slot && !$slot->is_booked) {
            $this->selectedSlot = $slot;
            $this->showBookingForm = true;
            return;
        }

        // If slot is booked, show appointment options
        if ($slot && $slot->is_booked) {
            $this->showAppointmentOptions($slotId);
            return;
        }
    }


    public function submitBookingForm()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'age' => 'required|string|max:255',
            'specialty' => 'required|exists:specialties,id',
            'problem_description' => 'nullable|string',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'payment_status' => 'required|in:pending,success',
        ]);

        // Create the consultation
        $consultation = Consultation::create([
            'full_name' => $this->full_name,
            'contact_info' => $this->contact_info,
            'email' => $this->email,
            'age' => $this->age,
            'specialty' => Specialty::find($this->specialty)->name,
            'problem_description' => $this->problem_description,
            'appointment_time' => Carbon::parse($this->selectedSlot->availability->date)
                ->setTimeFromTimeString($this->selectedSlot->start_time),
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'consultation_status' => 'pending',
            'payment_status' => $this->payment_status,
            'status' => 'confirmed',
            'original_slot_id' => $this->selectedSlot->id,
            'current_slot_id' => $this->selectedSlot->id,
            'doctor_id' => $this->doctor->id,
        ]);

        // Update the slot as booked
        $this->selectedSlot->update(['is_booked' => true]);

        // Reset form and show success message
        $this->resetBookingForm();
        session()->flash('message', 'Appointment booked successfully!');
        $this->refreshSlots();
    }

    public function resetBookingForm()
    {
        $this->reset([
            'showBookingForm',
            'full_name',
            'contact_info',
            'email',
            'age',
            'problem_description',
            'payment_method',
            'consultation_status',
            'payment_status',
            'selectedSlot'
        ]);
        $this->amount = $this->doctor->consultation_fee;
        $this->specialty = $this->doctor->specialty_id;
    }

    // public function toggleSlot($date, $slotId)
    // {
    //     // First check if the date is in the past
    //     if (Carbon::parse($date)->isPast()) {
    //         session()->flash('error', 'Cannot modify slots for past dates');
    //         return;
    //     }

    //     $slot = DoctorAvailabilitySlot::find($slotId);

    //     if ($slot) {
    //         try {
    //             $newStatus = !$slot->is_booked;
    //             $slot->update(['is_booked' => $newStatus]);

    //             $this->dispatch('slot-updated');
    //             session()->flash('message', $newStatus ? 'Slot marked as booked!' : 'Slot marked as available!');

    //             // Reload slots for the current view
    //             if ($this->showDatePicker) {
    //                 $this->loadSlotsForSelectedDate();
    //             } else {
    //                 $this->loadDefaultSlots();
    //             }
    //         } catch (\Exception $e) {
    //             session()->flash('error', 'Error: ' . $e->getMessage());
    //         }
    //     }
    // }

    public function loadSlotsForSelectedDate()
    {
        if ($this->selectedDate) {
            $this->availabilitySlots = $this->doctor->getAvailabilityForDates([$this->selectedDate]);
        }
    }

    public function toggleDatePicker()
    {
        $this->showDatePicker = !$this->showDatePicker;
        if ($this->showDatePicker) {
            $this->selectedDate = now()->format('Y-m-d');
            $this->loadSlotsForSelectedDate();
        } else {
            $this->loadDefaultSlots();
        }
    }

       public function showAppointmentOptions($slotId)
        {
            // Reset all modals first
            $this->resetModals();

            // Load the slot with consultation relationship
            $this->selectedSlot = DoctorAvailabilitySlot::with(['consultation', 'availability'])->find($slotId);

            if (!$this->selectedSlot) {
                session()->flash('error', 'Slot not found');
                return;
            }

            // Always show booking details modal for booked slots
            $this->showBookingDetails = true;

            // If there's a consultation, populate the details
            if ($this->selectedSlot->consultation) {
                $consultation = $this->selectedSlot->consultation;
                $this->full_name = $consultation->full_name;
                $this->contact_info = $consultation->contact_info;
                $this->email = $consultation->email;
                $this->age = $consultation->age;
                $this->specialty = Specialty::where('name', $consultation->specialty)->first()->id ?? null;
                $this->problem_description = $consultation->problem_description;
                $this->payment_method = $consultation->payment_method;
                $this->amount = $consultation->amount;
                $this->consultation_status = $consultation->consultation_status;
            } else {
                // If no consultation found, try to find it by original_slot_id as well
                $consultation = Consultation::where('current_slot_id', $slotId)
                    ->orWhere('original_slot_id', $slotId)
                    ->first();

                if ($consultation) {
                    $this->selectedSlot->consultation = $consultation;
                }
            }
        }

    public function initiateCancel()
    {
        $this->showBookingDetails = false;
        $this->showCancelModal = true;
    }

    public function initiateReschedule()
    {
        $this->showBookingDetails = false;

        // Get next 2 days available slots
        $dates = [
            now()->addDay()->format('Y-m-d'),
            now()->addDays(2)->format('Y-m-d')
        ];

        $this->availableRescheduleSlots = $this->doctor->getAvailabilityForDates($dates)
            ->flatMap(function ($availability) {
                return $availability->slots->filter(function ($slot) {
                    return !$slot->is_booked;
                });
            });

        $this->showRescheduleModal = true;
    }

    public function cancelAppointment()
    {
        $this->validate([
            'selectedCancellationReason' => 'required|exists:cancellation_reasons,id',
        ]);

        $consultation = $this->selectedSlot->consultation;

        if ($consultation) {
            // Update the consultation with cancellation details
            $consultation->update([
                'status' => 'cancelled',
                'cancellation_reason_id' => $this->selectedCancellationReason,
                'current_slot_id' => null
            ]);

            // Free up the slot
            $this->selectedSlot->update(['is_booked' => false]);

            // Get the cancellation reason text
            $reason = $this->cancellationReasons->firstWhere('id', $this->selectedCancellationReason)->reason;

            // Set success message and show success modal
            $this->successMessage = "Appointment was cancelled due to reason: $reason";
            $this->showSuccessModal = true;
        }

        $this->resetModals();
        $this->refreshSlots();
    }

    public function rescheduleAppointment()
    {
        $this->validate([
            'newSlotId' => 'required|exists:doctor_availability_slots,id',
        ]);

         $this->isRescheduling = true;

        $newSlot = DoctorAvailabilitySlot::find($this->newSlotId);
        $consultation = $this->selectedSlot->consultation;

        if ($consultation && $newSlot) {
            // Verify the new slot isn't already booked
            if ($newSlot->is_booked) {
                session()->flash('error', 'The selected slot has already been booked. Please choose another slot.');
                return;
            }

            // Start a database transaction for atomic operations
            DB::transaction(function () use ($consultation, $newSlot) {
                // Free up the old slot
                $this->selectedSlot->update(['is_booked' => false]);

                // Book the new slot
                $newSlot->update(['is_booked' => true]);

                // Update consultation with new slot
                $consultation->update([
                    'status' => 'rescheduled',
                    'current_slot_id' => $newSlot->id,
                    'appointment_time' => Carbon::parse($newSlot->availability->date)
                        ->setTimeFromTimeString($newSlot->start_time)
                ]);
            });

            // Set success message
            $this->successMessage = 'Appointment rescheduled successfully!';
            $this->showSuccessModal = true;

            // Reset other modals
            $this->showRescheduleModal = false;
        } else {
             $this->isRescheduling = false;
            session()->flash('error', 'Error rescheduling appointment. Please try again.');
        }
    }

    public function createConsultationForSlot()
    {
        if ($this->selectedSlot) {
            // Reset the modal and show booking form
            $this->showBookingDetails = false;
            $this->showBookingForm = true;

            // Pre-populate with default values
            $this->amount = $this->doctor->consultation_fee;
            $this->specialty = $this->doctor->specialty_id;
            $this->payment_method = 'cash';
            $this->consultation_status = 'pending';
            $this->payment_status = 'pending';
        }
    }

    public function unmarkSlotAsBooked()
    {
        if ($this->selectedSlot) {
            $this->selectedSlot->update(['is_booked' => false]);
            $this->resetModals();
            $this->refreshSlots();
            session()->flash('message', 'Slot marked as available successfully!');
        }
    }

    public function resetModals()
    {
        $this->showAppointmentModal = false;
        $this->showCancelModal = false;
        $this->showRescheduleModal = false;
        $this->showSuccessModal = false;
        $this->showBookingForm = false;
        $this->showBookingDetails = false;
        $this->selectedSlot = null;
        $this->selectedCancellationReason = null;
        $this->newSlotId = null;
        $this->successMessage = '';

        // Clear all form fields
        $this->reset([
            'full_name',
            'contact_info',
            'email',
            'age',
            'problem_description',
            'payment_method',
            'consultation_status',
            'payment_status'
        ]);

        // Reset to default values
        $this->amount = $this->doctor->consultation_fee;
        $this->specialty = $this->doctor->specialty_id;
        $this->payment_status = 'pending';
    }

    public function render()
    {
        return view('livewire.doctors.availability')
            ->layout('layouts.app', [
                'title' => 'Doctor Availability - ' . $this->doctor->name
            ]);
    }
}
