<?php

namespace App\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $content = '';
    public $thumbnail;
    public $meta_title = '';
    public $meta_keywords = '';
    public $meta_description = '';
    public $status = 'draft';

   protected $listeners = ['contentUpdated'];

    protected $rules = [
        'title' => 'required|string|max:255',

        'content' => 'nullable|string',
        'thumbnail' => 'nullable|image|max:2048',
        'meta_title' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'status' => 'required|in:published,draft',
    ];

    public function contentUpdated($value)
    {
        $this->content = $value;
    }

    public function dehydrate()
    {
        $this->dispatch('tinymce:destroy');
    }

    public function hydrate()
    {
        $this->dispatch('tinymce:init');
    }

    public function save()
    {
        $this->validate();

        $thumbnailPath = null;
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('blogs', 'public');
        }

        Blog::create([
            'title' => $this->title,

            'content' => $this->content,
            'thumbnail' => $thumbnailPath,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Blog created successfully!');
        return redirect()->route('blogs.index');
    }

    public function render()
    {
        return view('livewire.blogs.create')->layout('layouts.app', [
            'title' => 'Create New Blog'
        ]);
    }
}
