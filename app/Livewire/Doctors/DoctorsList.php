<?php

namespace App\Livewire\Doctors;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Doctor;

class DoctorsList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';

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

    public function render()
    {
        return view('livewire.doctors.doctors-list', [
            'doctors' => Doctor::with('specialty')
                ->where('is_active', true) // Only show active doctors
                ->when($this->search, function ($query) {
                    return $query->where(function($q) {
                        $q->where('name', 'like', '%'.$this->search.'%')
                          ->orWhereHas('specialty', function($q) {
                              $q->where('name', 'like', '%'.$this->search.'%');
                          });
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Doctors List'
        ]);
    }
}
