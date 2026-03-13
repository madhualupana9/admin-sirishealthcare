<?php

namespace App\Livewire\SubBranchHospitals;

use App\Models\SubBranchHospital;
use App\Models\Hostel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $subBranchId;
    public $hospital_id;
    public $hospitalSearch = '';
    public $selectedHospitalName = '';
    public $name;
    public $image;
    public $currentImage;
    public $city;
    public $state;
    public $address;
    public $description;
    public $contact_number;
    public $is_active;

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

    public function mount(SubBranchHospital $subBranch)
    {
        $this->subBranchId = $subBranch->id;
        $this->hospital_id = $subBranch->hospital_id;
        $this->selectedHospitalName = $subBranch->hospital->hospital_name ?? '';
        $this->name = $subBranch->name;
        $this->city = $subBranch->city;
        $this->state = $subBranch->state;
        $this->address = $subBranch->address;
        $this->description = $subBranch->description;
        $this->contact_number = $subBranch->contact_number;
        $this->is_active = $subBranch->is_active;
        $this->currentImage = $subBranch->image;

        $this->dispatch('refreshEditor', content: $this->description);
    }

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

        $subBranch = SubBranchHospital::findOrFail($this->subBranchId);

        $data = [
            'hospital_id' => $this->hospital_id,
            'name' => $this->name,
            'city' => $this->city,
            'state' => $this->state,
            'address' => $this->address,
            'description' => $this->description,
            'contact_number' => $this->contact_number,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            if ($this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $data['image'] = $this->image->store('sub-branch-hospitals', 'public');
        }

        $subBranch->update($data);

        session()->flash('message', 'Sub branch hospital updated successfully!');
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

        return view('livewire.sub-branch-hospitals.edit', [
            'hospitals' => $hospitals
        ])->layout('layouts.app', [
            'title' => 'Edit Sub Branch Hospital: ' . $this->name
        ]);
    }
}
