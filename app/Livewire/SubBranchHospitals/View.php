<?php

namespace App\Livewire\SubBranchHospitals;

use App\Models\SubBranchHospital;
use Livewire\Component;

class View extends Component
{
    public SubBranchHospital $subBranch;

    public function mount(SubBranchHospital $subBranch)
    {
        $this->subBranch = $subBranch;
    }

    public function render()
    {
        return view('livewire.sub-branch-hospitals.view')
            ->layout('layouts.app', [
                'title' => 'View Sub Branch: ' . $this->subBranch->name
            ]);
    }
}
