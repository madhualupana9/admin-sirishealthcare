<?php

namespace App\Livewire\SubBranchHospitals;

use App\Models\SubBranchHospital;
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

    public function deleteSubBranch($id)
    {
        $subBranch = SubBranchHospital::findOrFail($id);
        $subBranch->delete();
        $this->dispatch('notify', 'Sub branch hospital deleted successfully!');
    }

    public function render()
    {
        $subBranches = SubBranchHospital::with('hospital')
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('city', 'like', '%'.$this->search.'%')
                            ->orWhere('state', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.sub-branch-hospitals.index', [
            'subBranches' => $subBranches
        ])->layout('layouts.app', [
            'title' => 'Manage Sub Branch Hospitals'
        ]);
    }
}
