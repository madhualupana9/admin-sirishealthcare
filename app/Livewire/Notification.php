<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $message;
    public $type = 'success';
    public $show = false;

    protected $listeners = ['notify'];

    public function notify($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

        $this->dispatch('notify-show');

        $this->dispatch('notify-hide');
    }

    public function render()
    {
        return view('livewire.notification');
    }
}