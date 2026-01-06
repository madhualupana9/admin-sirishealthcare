<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10]
    ];

    public function deleteSpecialty($specialtyId)
    {
        $specialty = Specialty::findOrFail($specialtyId);
        $specialty->delete();
        $this->dispatch('notify', 'Specialty deleted successfully!');
    }

    public function render()
    {
        $specialties = Specialty::when($this->search, function ($query) {
            return $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.specialties.index', [
            'specialties' => $specialties
        ])->layout('layouts.app', [
            'title' => 'Manage Specialties'
        ]);
    }
}
