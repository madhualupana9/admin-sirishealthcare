<?php

namespace App\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selected = [];
    public $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField',
        'sortDirection',
        'statusFilter' => ['except' => '']
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deleteBlog($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $blog->delete();
        session()->flash('message', 'Blog deleted successfully!');
    }

    public function bulkDelete()
    {
        Blog::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        session()->flash('message', 'Selected blogs deleted successfully!');
    }

    public function render()
    {
        return view('livewire.blogs.index', [
            'blogs' => Blog::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query->where('title', 'like', '%'.$this->search.'%')
                            ->orWhere('content', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->statusFilter, function ($query) {
                    $query->where('status', $this->statusFilter);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Manage Blogs'
        ]);
    }
}
