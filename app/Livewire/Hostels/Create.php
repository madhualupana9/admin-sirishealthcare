<?php

namespace App\Livewire\Hostels;

use App\Models\Hostel;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $hospital_name = '';
    public $image;
    public $city = '';
    public $state = '';
    public $description = '';
    public $contact_number = '';
    public $is_active = true;
    public $specialtySearch = '';
    public $specialtyResults = [];
    public $selectedSpecialties = [];
    public $showSpecialtyDropdown = false;
    public $selectAllSpecialties = false;

    protected $rules = [
        'hospital_name' => 'required|string|max:255',
        'image' => 'nullable|image|max:10240', // 10MB
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'description' => 'nullable|string',
        'contact_number' => 'nullable|string|max:20',
        'is_active' => 'boolean',
        'selectedSpecialties' => 'required|array|min:1',
    ];

    public function mount()
    {
        $this->loadRecentSpecialties();
    }

    public function loadRecentSpecialties()
    {
        $this->specialtyResults = Specialty::latest()
            ->limit(20)
            ->get()
            ->toArray();
        $this->updateSelectAllState();
    }

    public function toggleSpecialtyDropdown()
    {
        $this->showSpecialtyDropdown = !$this->showSpecialtyDropdown;
        if ($this->showSpecialtyDropdown) {
            $this->loadRecentSpecialties();
        }
    }

    public function updatedSpecialtySearch($value)
{
    if (strlen($value)) {
        $this->specialtyResults = Specialty::where('name', 'like', '%' . $value . '%')
            ->limit(20)
            ->get()
            ->toArray();
    } else {
        $this->loadRecentSpecialties();
    }

    $this->updateSelectAllState();
}


    public function selectSpecialty($specialtyId)
    {
        if (($key = array_search($specialtyId, $this->selectedSpecialties)) !== false) {
            unset($this->selectedSpecialties[$key]);
        } else {
            $this->selectedSpecialties[] = $specialtyId;
        }
        $this->selectedSpecialties = array_values($this->selectedSpecialties);
        $this->updateSelectAllState();
    }

    public function toggleSelectAll()
    {
        $currentIds = collect($this->specialtyResults)->pluck('id')->toArray();

        if ($this->selectAllSpecialties) {
            $this->selectedSpecialties = array_unique(array_merge($this->selectedSpecialties, $currentIds));
        } else {
            $this->selectedSpecialties = array_diff($this->selectedSpecialties, $currentIds);
        }
        $this->selectedSpecialties = array_values($this->selectedSpecialties);
    }

    public function removeSpecialty($index)
    {
        unset($this->selectedSpecialties[$index]);
        $this->selectedSpecialties = array_values($this->selectedSpecialties);
        $this->updateSelectAllState();
    }

    protected function updateSelectAllState()
    {
        if (empty($this->specialtyResults)) {
            $this->selectAllSpecialties = false;
            return;
        }

        $currentIds = collect($this->specialtyResults)->pluck('id')->toArray();
        $this->selectAllSpecialties = count(array_intersect($currentIds, $this->selectedSpecialties)) === count($currentIds);
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('hostels', 'public');
        }

        $hostel = Hostel::create([
            'hospital_name' => $this->hospital_name,
            'image' => $imagePath,
            'city' => $this->city,
            'state' => $this->state,
            'description' => $this->description,
            'contact_number' => $this->contact_number,
            'is_active' => $this->is_active,
        ]);

        $hostel->specialties()->attach($this->selectedSpecialties);

        session()->flash('message', 'Hospital created successfully!');
        return redirect()->route('hospitals.index');
    }

    public function render()
    {
        return view('livewire.hostels.create')
            ->layout('layouts.app', [
                'title' => 'Create New Hospital'
            ]);
    }
}
