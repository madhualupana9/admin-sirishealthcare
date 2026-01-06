<?php

namespace App\Livewire\Users;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $selectedPermissions = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'nullable|string|confirmed|min:8',
        'role' => 'required|in:super_admin,admin,user',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->selectedPermissions = $user->permissions->pluck('id')->toArray();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'role' => 'required|in:super_admin,admin,user',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);

         // Update permissions if not admin
        if ($this->role !== 'admin') {
            $this->user->assignPermissions($this->selectedPermissions);
        } else {
            // Remove all permissions if changed to admin
            $this->user->permissions()->detach();
        }

        session()->flash('message', 'User successfully updated.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('livewire.users.edit', [
            'permissions' => $permissions,
        ])->layout('layouts.app', [
            'title' => 'Edit User'
        ]);
    }
}
