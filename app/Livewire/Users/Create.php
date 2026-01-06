<?php

namespace App\Livewire\Users;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role = 'user';
    public $selectedPermissions = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'role' => 'required|in:super_admin,admin,user',
    ];

    public function mount()
    {
        // Only allow admin to create super_admin if they are super_admin
        if (auth()->user()->role !== 'super_admin') {
            $this->role = 'user';
        }
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        // Assign permissions if not admin (admins have all permissions)
    if ($this->role !== 'admin') {
        $user->assignPermissions($this->selectedPermissions);
    }

        session()->flash('message', 'User successfully created.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('livewire.users.create', [
            'permissions' => $permissions,
        ])->layout('layouts.app', [
            'title' => 'Create User'
        ]);
    }
}
