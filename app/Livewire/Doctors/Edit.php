<?php

namespace App\Livewire\Doctors;

use App\Models\Doctor;
use App\Models\Hostel;
use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $doctorId;
    public $name;
    public $education;
    public $specialty_id;
    public $hospital_id;
    public $experience;
    public $languages;
    public $country;
    public $about_expert;
    public $education_training;
    public $professional_work;
    public $photo;
    public $currentPhoto;
    public $is_active;
    public $consultation_fee;

    protected $rules = [
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

    public function mount(Doctor $doctor)
    {
        $this->doctorId = $doctor->id;
        $this->name = $doctor->name;
        $this->education = $doctor->education;
        $this->specialty_id = $doctor->specialty_id;
        $this->hospital_id = $doctor->hospital_id;
        $this->experience = $doctor->experience;
        $this->languages = $doctor->languages;
        $this->country = $doctor->country;
        $this->about_expert = $doctor->about_expert;
        $this->education_training = $doctor->education_training;
        $this->professional_work = $doctor->professional_work;
        $this->currentPhoto = $doctor->photo;
        $this->is_active = $doctor->is_active;
        $this->consultation_fee = $doctor->consultation_fee;
    }

    public function save()
    {
        $this->validate();

        $doctor = Doctor::findOrFail($this->doctorId);

        $data = [
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
            'is_active' => $this->is_active,
            'consultation_fee' => $this->is_active ? $this->consultation_fee : null,
        ];

        if ($this->photo) {
            // Delete old photo if it exists
            if ($this->currentPhoto) {
                Storage::disk('public')->delete($this->currentPhoto);
            }
            // Store new photo
            $data['photo'] = $this->photo->store('doctors', 'public');
        }

        $doctor->update($data);

        session()->flash('message', 'Doctor updated successfully!');
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
        return view('livewire.doctors.edit', [
            'specialties' => Specialty::orderBy('name')->get(),
            'hospitals' => Hostel::orderBy('hospital_name')->get(),
            'countries' => [
                'United States', 'Canada', 'United Kingdom', 'Australia', 'Germany',
                'France', 'Japan', 'China', 'India', 'Brazil', 'Mexico'
            ],
            'doctor' => Doctor::find($this->doctorId)
        ])->layout('layouts.app', [
            'title' => 'Edit Doctor: ' . $this->name
        ]);
    }
}
