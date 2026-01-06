<?php

namespace App\Livewire\Specialties;

use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Specialty $specialty;
    public $name;
    public $slug;
    public $description;
    public $logo_image;
    public $image;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $currentLogoImage;
    public $currentImage;

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:specialties,slug',
        'description' => 'nullable|string',
        'logo_image' => 'nullable|image|max:2048',
        'image' => 'nullable|image|max:2048',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
    ];

    public function mount(Specialty $specialty)
    {
        $this->specialty = $specialty;
        $this->name = $specialty->name;
        $this->slug = $specialty->slug;
        $this->description = $specialty->description;
        $this->currentLogoImage = $specialty->logo_image;
        $this->currentImage = $specialty->image;
        $this->meta_title = $specialty->meta_title;
        $this->meta_description = $specialty->meta_description;
        $this->meta_keywords = $specialty->meta_keywords;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:specialties,slug,'.$this->specialty->id,
            'description' => 'nullable|string',
            'logo_image' => 'nullable|image|max:2048',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ];

        // Handle logo image update
        if ($this->logo_image) {
            // Delete old logo if exists
            if ($this->currentLogoImage) {
                Storage::disk('public')->delete($this->currentLogoImage);
            }
            $data['logo_image'] = $this->logo_image->store('specialties/logos', 'public');
        } elseif ($this->currentLogoImage === null) {
            // If logo was removed
            if ($this->specialty->logo_image) {
                Storage::disk('public')->delete($this->specialty->logo_image);
            }
            $data['logo_image'] = null;
        }

        // Handle main image update
        if ($this->image) {
            // Delete old image if exists
            if ($this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $data['image'] = $this->image->store('specialties/images', 'public');
        } elseif ($this->currentImage === null) {
            // If image was removed
            if ($this->specialty->image) {
                Storage::disk('public')->delete($this->specialty->image);
            }
            $data['image'] = null;
        }

        $this->specialty->update($data);

        $this->dispatch('notify', 'Specialty updated successfully!');
        return redirect()->route('specialties.index');
    }

    public function removeLogo()
    {
        $this->currentLogoImage = null;
    }

    public function removeImage()
    {
        $this->currentImage = null;
    }

    public function render()
    {
        return view('livewire.specialties.edit')->layout('layouts.app', [
            'title' => 'Edit Specialty'
        ]);
    }
}
