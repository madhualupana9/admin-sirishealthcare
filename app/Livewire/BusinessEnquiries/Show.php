<?php

namespace App\Livewire\BusinessEnquiries;

use App\Models\BusinessEnquiry;
use Livewire\Component;

class Show extends Component
{
    public BusinessEnquiry $enquiry;

    public function mount(BusinessEnquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function toggleEnquiryStatus()
    {
        $this->enquiry->update([
            'enquirer_status' => $this->enquiry->enquirer_status === 'pending' ? 'enquired' : 'pending'
        ]);
        $this->dispatch('notify', 'Enquiry status updated!');
    }

    public function toggleCheckStatus()
    {
        $this->enquiry->update([
            'enquirer_check' => !$this->enquiry->enquirer_check
        ]);
        $this->dispatch('notify', 'Check status updated!');
    }

    public function render()
    {
        return view('livewire.business-enquiries.show')
            ->layout('layouts.app', [
                'title' => 'View Enquiry - ' . $this->enquiry->enquirer_name
            ]);
    }
}
