<?php

namespace App\Livewire\BusinessEnquiries;

use App\Models\BusinessEnquiry;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField',
        'sortDirection'
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

    public function deleteEnquiry($enquiryId)
    {
        $enquiry = BusinessEnquiry::findOrFail($enquiryId);
        $enquiry->delete();
        $this->dispatch('notify', 'Enquiry deleted successfully!');
    }

    public function toggleEnquiryStatus($enquiryId)
    {
        $enquiry = BusinessEnquiry::findOrFail($enquiryId);
        $enquiry->update([
            'enquirer_status' => $enquiry->enquirer_status === 'pending' ? 'enquired' : 'pending'
        ]);
        $this->dispatch('notify', 'Enquiry status updated!');
    }

    public function toggleCheckStatus($enquiryId)
    {
        $enquiry = BusinessEnquiry::findOrFail($enquiryId);
        $enquiry->update([
            'enquirer_check' => !$enquiry->enquirer_check
        ]);
        $this->dispatch('notify', 'Check status updated!');
    }

    public function render()
    {
        return view('livewire.business-enquiries.index', [
            'enquiries' => BusinessEnquiry::when($this->search, function ($query) {
                return $query->where('enquirer_name', 'like', '%'.$this->search.'%')
                    ->orWhere('enquirer_email', 'like', '%'.$this->search.'%')
                    ->orWhere('enquirer_mobile', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Manage Business Enquiries'
        ]);
    }
}
