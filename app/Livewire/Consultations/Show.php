<?php

namespace App\Livewire\Consultations;

use App\Models\Consultation;
use App\Models\CancellationReason;
use Livewire\Component;

class Show extends Component
{
    public Consultation $consultation;
    public $showConfirmModal = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(Consultation $consultation)
    {
        $this->consultation = $consultation->load([
            'slot.availability',
            'originalSlot.availability',
            'cancellationReason',
            'doctor',
            'specialtyModel'
        ]);
    }

    public function confirmStatusChange()
    {
        $this->showConfirmModal = true;
    }

    public function toggleConsultationStatus()
    {
        $this->consultation->update([
            'consultation_status' => $this->consultation->consultation_status === 'pending' ? 'consulted' : 'pending'
        ]);

        $this->showConfirmModal = false;
        $this->dispatch('refreshComponent');

        session()->flash('message', 'Consultation status has been updated successfully!');
    }

    public function cancelStatusChange()
    {
        $this->showConfirmModal = false;
    }

    public function render()
    {
        return view('livewire.consultations.show')
            ->layout('layouts.app', [
                'title' => 'View Consultation - ' . $this->consultation->full_name
            ]);
    }
}
