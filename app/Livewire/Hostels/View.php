<?php

namespace App\Livewire\Hostels;

use App\Models\Hostel;
use Livewire\Component;

class View extends Component
{
    public Hostel $hostel;

    public function mount(Hostel $hostel)
    {
        $this->hostel = $hostel;
    }

    public function render()
    {
        return view('livewire.hostels.view')
            ->layout('layouts.app', [
                'title' => 'View Hostel: ' . $this->hostel->hospital_name
            ]);
    }
}