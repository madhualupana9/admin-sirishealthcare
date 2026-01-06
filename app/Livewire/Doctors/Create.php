<?php

namespace App\Livewire\Doctors;

use App\Models\Doctor;
use App\Models\Hostel;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $education = '';
    public $specialty_id = '';
    public $hospital_id = '';
    public $experience = '';
    public $languages = '';
    public $country = '';
    public $about_expert = '';
    public $education_training = '';
    public $professional_work = '';
    public $photo;
    public $is_active = false;
    public $consultation_fee;


       protected function rules()
        {
            $rules = [
                'name' => 'required|string|max:255',
                'education' => 'required|string|max:255',
                'specialty_id' => 'required|exists:specialties,id',
                'hospital_id' => 'required|exists:hostels,id',
                'experience' => 'nullable|string|max:255',
                'languages' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'about_expert' => 'nullable|string',
                'education_training' => 'nullable|string',
                'professional_work' => 'nullable|string',
                'photo' => 'nullable|image|max:2048',
                'is_active' => 'boolean',
                'consultation_fee' => 'nullable|numeric|min:0',
            ];

            if ($this->is_active) {
                $rules['consultation_fee'] = 'required|numeric|min:0';
            }

            return $rules;
        }




      public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('doctors', 'public');
        }

        Doctor::create([
            'name' => $this->name,
            'education' => $this->education,
            'specialty_id' => $this->specialty_id,
            'hospital_id' => $this->hospital_id,
            'experience' => $this->experience,
            'languages' => $this->languages,
            'country' => $this->country,
            'about_expert' => $this->about_expert,
            'education_training' => $this->education_training,
            'professional_work' => $this->professional_work,
            'photo' => $photoPath,
            'is_active' => $this->is_active,
            'consultation_fee' => $this->is_active ? $this->consultation_fee : null,
        ]);

        session()->flash('message', 'Doctor created successfully!');
        return redirect()->route('doctors.index');
    }

    public function toggleActive()
    {
        $this->is_active = !$this->is_active;

        // Reset consultation fee when unchecked
        if (!$this->is_active) {
            $this->consultation_fee = null;
        }
    }

    public function render()
    {


        return view('livewire.doctors.create', [
            'specialties' => Specialty::orderBy('name')->get(),
            'hospitals' => Hostel::orderBy('hospital_name')->get(),
            'countries' => [
                'United States', 'Canada', 'United Kingdom', 'Australia', 'Germany',
                'France', 'Japan', 'China', 'India', 'Brazil', 'Mexico'
            ]
        ])->layout('layouts.app', [
            'title' => 'Create New Doctor'
        ]);
    }
}
