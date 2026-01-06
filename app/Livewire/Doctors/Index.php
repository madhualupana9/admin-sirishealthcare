<?php

namespace App\Livewire\Doctors;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selected = [];

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

    public function deleteDoctor($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->delete();
        $this->dispatchBrowserEvent('notify', 'Doctor deleted successfully!');
    }

    public function bulkDelete()
    {
        Doctor::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatchBrowserEvent('notify', 'Selected doctors deleted successfully!');
    }

    public function render()
    {
        return view('livewire.doctors.index', [
            'doctors' => Doctor::with(['specialty', 'hospital'])
                ->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('education', 'like', '%'.$this->search.'%')
                            ->orWhere('experience', 'like', '%'.$this->search.'%')
                            ->orWhereHas('specialty', function ($query) {
                                $query->where('name', 'like', '%'.$this->search.'%');
                            })
                            ->orWhereHas('hospital', function ($query) {
                                $query->where('hospital_name', 'like', '%'.$this->search.'%');
                            });
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Manage Doctors'
        ]);
    }
}
