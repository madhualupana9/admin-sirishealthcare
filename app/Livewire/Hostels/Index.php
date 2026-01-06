<?php

namespace App\Livewire\Hostels;

use App\Models\Hostel;
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

    public function deleteHostel($hostelId)
    {
        $hostel = Hostel::findOrFail($hostelId);
        $hostel->delete();
        $this->dispatch('notify', 'Hostel deleted successfully!');
    }

    public function render()
    {
        $hostels = Hostel::when($this->search, function ($query) {
            return $query->where('hospital_name', 'like', '%'.$this->search.'%')
                        ->orWhere('city', 'like', '%'.$this->search.'%')
                        ->orWhere('state', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.hostels.index', [
            'hostels' => $hostels
        ])->layout('layouts.app', [
            'title' => 'Manage Hostels'
        ]);
    }
}