<?php

namespace App\Livewire\Hostels;

use App\Models\Hostel;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $hostelId;
    public $hospital_name;
    public $image;
    public $currentImage;
    public $city;
    public $state;
    public $description;
    public $contact_number;
    public $is_active;
    public $specialtySearch = '';
    public $selectedSpecialties = [];
    public $specialtyResults = [];
    public $selectAllSpecialties = false;

    protected $listeners = ['refreshEditor'];

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

    public function mount(Hostel $hostel)
    {
        if ($hostel) {
        $this->description = $hostel->description;
        $this->dispatch('refreshEditor', content: $this->description);
       }

        $this->hostelId = $hostel->id;
        $this->hospital_name = $hostel->hospital_name;
        $this->city = $hostel->city;
        $this->state = $hostel->state;
        $this->description = $hostel->description;
        $this->contact_number = $hostel->contact_number;
        $this->is_active = $hostel->is_active;
        $this->currentImage = $hostel->image;
        $this->selectedSpecialties = $hostel->specialties->pluck('id')->toArray();
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

    public function updatedSpecialtySearch($value)
    {
        if (strlen($value) >= 3) {
            $this->specialtyResults = Specialty::where('name', 'like', '%'.$value.'%')
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
            // Add all current IDs to selection
            $this->selectedSpecialties = array_unique(array_merge($this->selectedSpecialties, $currentIds));
        } else {
            // Remove all current IDs from selection
            $this->selectedSpecialties = array_diff($this->selectedSpecialties, $currentIds);
        }

        $this->selectedSpecialties = array_values($this->selectedSpecialties);
        $this->updateSelectAllState();
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
        $selectedIds = $this->selectedSpecialties;

        // Check if all current IDs are in selected IDs
        $this->selectAllSpecialties = count(array_intersect($currentIds, $selectedIds)) === count($currentIds);
    }

    public function save()
    {
        $this->validate();

        $hostel = Hostel::findOrFail($this->hostelId);

        $data = [
            'hospital_name' => $this->hospital_name,
            'city' => $this->city,
            'state' => $this->state,
            'description' => $this->description,
            'contact_number' => $this->contact_number,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            // Delete old image if it exists
            if ($this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $data['image'] = $this->image->store('hostels', 'public');
        } elseif ($this->currentImage === null) {
            // If current image was removed and no new image uploaded
            $data['image'] = null;
        }

        $hostel->update($data);

        // Sync the specialties in the pivot table
        $hostel->specialties()->sync($this->selectedSpecialties);

        session()->flash('message', 'Hospital updated successfully!');
        return redirect()->route('hospitals.index');
    }

    public function render()
    {
        return view('livewire.hostels.edit')
            ->layout('layouts.app', [
                'title' => 'Edit Hostel: ' . $this->hospital_name
            ]);
    }
}
