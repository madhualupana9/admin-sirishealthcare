<?php

namespace App\Livewire\DoctorEnquiries;

use App\Models\DoctorEnquiry;
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
        $enquiry = DoctorEnquiry::findOrFail($enquiryId);
        $enquiry->delete();
        $this->dispatch('notify', 'Enquiry deleted successfully!');
    }

    public function toggleEnquiryStatus($enquiryId)
    {
        // $enquiry = DoctorEnquiry::findOrFail($enquiryId);
        // $enquiry->update([
        //     'doctor_enquiry_status' => $enquiry->doctor_enquiry_status === 'pending' ? 'enquired' : 'pending'
        // ]);
        // $this->dispatch('notify', 'Enquiry status updated!');
    }

    public function render()
    {
        return view('livewire.doctor-enquiries.index', [
            'enquiries' => DoctorEnquiry::when($this->search, function ($query) {
                return $query->where('first_name', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('doctor_name', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage)
        ])->layout('layouts.app', [
            'title' => 'Manage Doctor Enquiries'
        ]);
    }
}
