<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $slug = '';
    public $logo_image;
    public $image;
    public $description = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:specialties,slug',
        'logo_image' => 'nullable|image|max:2048',
        'image' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ];

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $logoImagePath = null;
        if ($this->logo_image) {
            $logoImagePath = $this->logo_image->store('specialties/logos', 'public');
        }

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('specialties/images', 'public');
        }

        Specialty::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'logo_image' => $logoImagePath,
            'image' => $imagePath,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ]);

        session()->flash('message', 'Specialty created successfully!');
        return redirect()->route('specialties.index');
    }

    public function render()
    {
        return view('livewire.specialties.create')
            ->layout('layouts.app', [
                'title' => 'Create New Specialty'
            ]);
    }
}
