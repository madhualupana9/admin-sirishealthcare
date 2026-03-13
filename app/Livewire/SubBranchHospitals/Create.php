<?php

namespace App\Livewire\SubBranchHospitals;

use App\Models\SubBranchHospital;
use App\Models\Hostel;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $hospital_id = '';
    public $hospitalSearch = '';
    public $selectedHospitalName = '';
    public $name = '';
    public $image;
    public $city = '';
    public $state = '';
    public $address = '';
    public $description = '';
    public $contact_number = '';
    public $is_active = true;

    protected $listeners = ['refreshEditor'];

    protected $rules = [
        'hospital_id' => 'required|exists:hostels,id',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|max:10240', // 10MB
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'address' => 'nullable|string',
        'description' => 'nullable|string',
        'contact_number' => 'nullable|string|max:20',
        'is_active' => 'boolean',
    ];

    public function selectHospital($id, $name)
    {
        $this->hospital_id = $id;
        $this->selectedHospitalName = $name;
        $this->hospitalSearch = '';
    }

    public function clearHospital()
    {
        $this->hospital_id = '';
        $this->selectedHospitalName = '';
        $this->hospitalSearch = '';
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('sub-branch-hospitals', 'public');
        }

        SubBranchHospital::create([
            'hospital_id' => $this->hospital_id,
            'name' => $this->name,
            'image' => $imagePath,
            'city' => $this->city,
            'state' => $this->state,
            'address' => $this->address,
            'description' => $this->description,
            'contact_number' => $this->contact_number,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'Sub branch hospital created successfully!');
        return redirect()->route('sub-branch-hospitals.index');
    }

    public function render()
    {
        $hospitals = [];
        if (strlen($this->hospitalSearch) >= 2) {
            $hospitals = Hostel::where('hospital_name', 'like', '%' . $this->hospitalSearch . '%')
                ->where('is_active', true)
                ->limit(10)
                ->get();
        }

        return view('livewire.sub-branch-hospitals.create', [
            'hospitals' => $hospitals
        ])->layout('layouts.app', [
            'title' => 'Create New Sub Branch Hospital'
        ]);
    }
}
