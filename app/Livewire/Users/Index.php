<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10]
    ];

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            $this->dispatch('notify', 'You cannot delete yourself!');
            return;
        }

        $user->delete();
        $this->dispatch('notify', 'User deleted successfully!');
    }

    public function render()
    {
        $users = User::when($this->search, function ($query) {
            return $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.users.index', [
            'users' => $users
        ])->layout('layouts.app', [
            'title' => 'Manage Users'
        ]);
    }
}