<?php

namespace App\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $blogId;
    public $title;
    public $description;
    public $content;
    public $thumbnail;
    public $currentThumbnail;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $status;

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

    public function mount(Blog $blog)
    {
        $this->blogId = $blog->id;
        $this->title = $blog->title;

        $this->content = $blog->content;
        $this->currentThumbnail = $blog->thumbnail;
        $this->meta_title = $blog->meta_title;
        $this->meta_keywords = $blog->meta_keywords;
        $this->meta_description = $blog->meta_description;
        $this->status = $blog->status;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,

            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
        ];

        if ($this->thumbnail) {
            // Delete old thumbnail if it exists
            if ($this->currentThumbnail) {
                Storage::disk('public')->delete($this->currentThumbnail);
            }
            // Store new thumbnail
            $data['thumbnail'] = $this->thumbnail->store('blogs', 'public');
        }

        Blog::findOrFail($this->blogId)->update($data);

        session()->flash('message', 'Blog updated successfully!');
        return redirect()->route('blogs.index');
    }

    public function render()
    {
        return view('livewire.blogs.edit', [
            'blog' => Blog::find($this->blogId)
        ])->layout('layouts.app', [
            'title' => 'Edit Blog: ' . $this->title
        ]);
    }
}
