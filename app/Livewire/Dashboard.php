<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Hostel;
use App\Models\Consultation;

class Dashboard extends Component
{
    public $readyToLoad = false;

    public function mount()
    {
        // This will trigger when the component first mounts
        $this->readyToLoad = true;
    }

    public function loadData()
    {
        // Explicit data loading method
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'hostelsCount' => $this->readyToLoad ? Hostel::count() : 0,
            'consultationsCount' => $this->readyToLoad ? Consultation::count() : 0,
        ])->layout('layouts.app', [
            'title' => 'Dashboard'
        ]);
    }
}
