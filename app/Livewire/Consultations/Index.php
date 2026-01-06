<?php

namespace App\Livewire\Consultations;

use App\Models\Consultation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField',
        'sortDirection'
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }


    public function deleteConsultation($consultationId)
    {
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->delete();
        $this->dispatch('notify', 'Consultation deleted successfully!');
    }



    public function render()
    {
        return view('livewire.consultations.index', [
            'consultations' => Consultation::with(['specialtyModel', 'doctor'])
                ->when($this->search, function ($query) {
                    return $query->where('full_name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('specialty', 'like', '%'.$this->search.'%')
                        ->orWhere('contact_info', 'like', '%'.$this->search.'%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Manage Consultations'
        ]);
    }

    public function toggleConsultationStatus($consultationId)
    {
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->update([
            'consultation_status' => $consultation->consultation_status === 'pending' ? 'consulted' : 'pending'
        ]);
        $this->dispatch('notify', 'Consultation status updated!');
    }
}
